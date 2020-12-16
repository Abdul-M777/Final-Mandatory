$(document).ready(function() {
    // $.getJSON('read.php', function(json) {
    // 	var tr=[];
    // 	for (var i = 0; i < json.length; i++) {
    // 		tr.push('<tr>');
    // 		tr.push('<td>' + json[i].id + '</td>');
    // 		tr.push('<td>' + json[i].name + '</td>');
    // 		tr.push('<td><button class=\'edit\'>Edit</button>&nbsp;&nbsp;<button class=\'delete\' id=' + json[i].id + '>Delete</button></td>');
    // 		tr.push('</tr>');
    // 	}
    // 	$('table').append($(tr.join('')));
    // });

    $.ajax({
        type:"GET",
        url: "API/artist",
        success: function(data){
            // const read = JSON.parse(data);
            // console.log(read);
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

        // var o = JSON.parse(data);
        // console.log(o);
        data = JSON.parse(data);
        console.log(data);
        var tr=[];
        for (var i = 0; i < data.length; i++) {
            tr.push('<tr>');
            tr.push('<td>' + data[i].ArtistId + '</td>');
            tr.push('<td>' + data[i].Name + '</td>');
            tr.push('<td><button class=\'edit\'>Edit</button>&nbsp;&nbsp;<button class=\'delete\' id=' + data[i].ArtistId + '>Delete</button></td>');
            tr.push('</tr>');
        }
        $('table').append($(tr.join('')));
        }
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
            url: "API/artist",
            data: JSON.stringify({'name': name}),
            cache: false,
            success: function(result) {
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
            console.log(id);
            var parent = $(this).parent().parent();
            $.ajax({
                type: "DELETE",
                url: "API/artist?id=" + id,
                cache: false,
                success: function() {
                    parent.fadeOut('slow', function() {
                        $(this).remove();
                    });
                    // location.reload(true)
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
        var name = parent.children("td:nth-child(2)");
        var buttons = parent.children("td:nth-child(3)");
        
        name.html("<input type='text' id='txtName' value='" + name.html() + "'/>");
        buttons.html("<button id='save'>Save</button>&nbsp;&nbsp;<button class='delete' id='" + id.html() + "'>Delete</button>");
    });
    
    $(document).delegate('#save', 'click', function() {
        var parent = $(this).parent().parent();
        
        var id = parent.children("td:nth-child(1)");
        var name = parent.children("td:nth-child(2)");
        var buttons = parent.children("td:nth-child(3)");
        
        $.ajax({
            type: "PUT",
            contentType: "application/json; charset=utf-8",
            url: "update",
            data: JSON.stringify({'id' : id.html(), 'name' : name.children("input[type=text]").val()}),
            cache: false,
            success: function() {
                name.html(name.children("input[type=text]").val());
                buttons.html("<button class='edit' id='" + id.html() + "'>Edit</button>&nbsp;&nbsp;<button class='delete' id='" + id.html() + "'>Delete</button>");
            },
            error: function() {
                alert('Error updating record');
            }
        });
    });

});