$(document).ready(function() {


    $("#btnSearch").on("click", function(e){
        e.preventDefault();
    
        var title = $("#searchAlbum").val();
            console.log(title);
        $.ajax({
            url: `API/albums?name=${title}`,
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

        // var o = JSON.parse(data);
        // console.log(o);
        data = JSON.parse(data);
        console.log(data);
        var tr=[];
        for (var i = 0; i < data.length; i++) {
            tr.push('<tr>');
            tr.push('<td>' + data[i].albumId + '</td>');
            tr.push('<td>' + data[i].title + '</td>');
            tr.push('<td>' + data[i].name + '</td>');
            tr.push('<td><button class=\'edit\'>Edit</button>&nbsp;&nbsp;<button class=\'delete\' id=' + data[i].AlbumId + '>Delete</button></td>');
            tr.push('</tr>');
        }
        $('table').append($(tr.join('')));
        }
    });

});
    
    $(document).delegate('#addNew', 'click', function(event) {
        event.preventDefault();
        
        var name = $('#name').val();
        var artist_id = $('#artistDrowpdownCreate').val();
        
        if(name == null || name == "") {
            alert("Album Name is required");
            return;
        }
        
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: "API/albums",
            data: JSON.stringify({
                'name': name,
                'artist_id': artist_id}),
            cache: false,
            success: function(result) {
                alert('Album added successfully');
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
            console.log("Album Id: "+id);
            var parent = $(this).parent().parent();
            $.ajax({
                type: "DELETE",
                url: "API/albums?id=" + id,
                cache: false,
                success: function() {
                    parent.fadeOut('slow', function() {
                        $(this).remove();
                    });
                     location.reload(true)
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
        var buttons = parent.children("td:nth-child(4)");
        
        name.html("<input type='text' id='txtName' value='" + name.html() + "'/>");
        buttons.html("<button id='save'>Save</button>&nbsp;&nbsp;<button class='delete' id='" + id.html() + "'>Delete</button>");
    });
    
    $(document).delegate('#save', 'click', function() {
        var parent = $(this).parent().parent();
        
        var id = parent.children("td:nth-child(1)");
        console.log(id);
        var name = parent.children("td:nth-child(2)");
        var buttons = parent.children("td:nth-child(4)");
        
        $.ajax({
            type: "PUT",
            contentType: "application/json; charset=utf-8",
            url: "API/albums",
            data: JSON.stringify({
                'id' : id.html(),
                'name' : name.children("input[type=text]").val()}),
            cache: false,
            success: function() {
                location.reload(true);
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

    $.ajax({
        type:"GET",
        url: "API/artists",
        success: function(data){
            data = JSON.parse(data);
            console.log(data);
            data.forEach(element => {
                $("#artistDrowpdownCreate").append($("<option>", {value: element['ArtistId'], text: element['Name']}));
            })

        }
    });

});