$(document).ready(function() {

    var new_data;

    $("#btnSearch").on("click", function(e){
        e.preventDefault();
    
        var title = $("#searchArtist").val();
            console.log(title);
        $.ajax({
            url: `API/artists?name=${title}`,
            type: "GET",
            success: function(data){
                data = data.replace(/\\n/g, "\\n")  
           .replace(/\\'/g, "\\'")
           .replace(/\\"/g, '\\"')
           .replace(/\\&/g, "\\&")
           .replace(/\\r/g, "\\r")
           .replace(/\\t/g, "\\t")
           .replace(/\\b/g, "\\b")
           .replace(/\\f/g, "\\f");
            // remove non-printable and other non-valid JSON chars
            data = data.replace(/[\u0000-\u0019]+/g,"");
    
                console.log(data);
                new_data = JSON.parse(data);
            console.log(new_data);
            var tr=[];
            for (var i = 0; i < new_data.length; i++) {
                tr.push('<tr>');
                tr.push('<td>' + new_data[i].ArtistId + '</td>');
                tr.push('<td>' + new_data[i].Name + '</td>');
                tr.push('<td><button class=\'edit\'>Edit</button>&nbsp;&nbsp;<button class=\'delete\' id=' + new_data[i].ArtistId + '>Delete</button></td>');
                tr.push('</tr>');
            }
            $('table').append($(tr.join('')));
            }
                
        })
    
       });
    
    

    $(document).delegate('#addNew', 'click', function(event) {
        event.preventDefault();
        
        var name = $('#name').val();
        
        if(name == null || name == "") {
            alert("Artist Name is required");
            return;
        }
        
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: "API/artists",
            data: JSON.stringify({'name': name}),
            cache: false,
            success: function(result) {
                console.log(name);
                console.log(result)
                alert('Artist added successfully');
                location.reload(true);
            },
            error: function(err) {
                alert(err);
                console.log("Error")
            }
        });
    });
    
    $(document).delegate('.delete', 'click', function() { 
        if (confirm('Do you really want to delete record?')) {
            var id = $(this).attr('id');
            console.log("ArtistId: "+id);
            var parent = $(this).parent().parent();
            $.ajax({
                type: "DELETE",
                url: "API/artists?id=" + id,
                cache: false,
                success: function(data) {
                    console.log(data);
                    console.log(data.length);
                    console.log(new_data);
                    try {
                        if(data.length == 27){
                            parent.fadeOut('slow', function() {
                            $(this).remove();
                            location.reload(true)
                            });
                        } else {
                            alert("Artist can not be deleted if artist has an album");
                        }
                        
                        
                    } catch (error) {
                        
                    }
                    
                },
                error: function() {
                    alert('Error deleting record');
                }
            });
        }
    });
    
    $(document).delegate('.edit', 'click', function() {
        var parent = $(this).parent().parent();
        
        var id = parent.children("td:nth-child(1)");
        console.log(id);
        var name = parent.children("td:nth-child(2)");
        var buttons = parent.children("td:nth-child(3)");
        
        name.html("<input type='text' id='txtName' value='" + name.html() + "'/>");
        buttons.html("<button id='save'>Save</button>&nbsp;&nbsp;<button class='delete' id='" + id.html() + "'>Delete</button>");
    });
    
    $(document).delegate('#save', 'click', function() {
        var parent = $(this).parent().parent();
        
        var id = parent.children("td:nth-child(1)");
        console.log(id);
        var name = parent.children("td:nth-child(2)");
        var buttons = parent.children("td:nth-child(3)");
        
        $.ajax({
            type: "PUT",
            contentType: "application/json; charset=utf-8",
            url: "API/artists",
            data: JSON.stringify({'id' : id.html(), 'name' : name.children("input[type=text]").val()}),
            cache: false,
            success: function() {
                location.reload(this);
                console.log(id.html());
                console.log(name.children("input[type=text]").val());
                name.html(name.children("input[type=text]").val());
                buttons.html("<button class='edit' id='" + id.html() + "'>Edit</button>&nbsp;&nbsp;<button class='delete' id='" + id.html() + "'>Delete</button>");
            },
            error: function() {
                alert('Error updating record');
            }
        });
    });

   

});