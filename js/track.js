$(document).ready(function() {

    var new_data;

    $("#btnSearch").on("click", function(e){
        e.preventDefault();
    
        var title = $("#searchTrack").val();
            console.log(title);
        $.ajax({
            url: `API/tracks?name=${title}`,
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
        new_data = JSON.parse(data);
        var tr=[];
        for (var i = 0; i < new_data.length; i++) {
            tr.push('<tr>');
            tr.push('<td>' + new_data[i].trackId + '</td>');
            tr.push('<td>' + new_data[i].trackName + '</td>');
            tr.push('<td>' + new_data[i].composer + '</td>');
            tr.push('<td>' + new_data[i].unitPrice + '</td>');
            if(new_data[i].MediaTypeId == "1"){
            tr.push('<td>' + "MPEG Audio file" + '</td>');
            } else if(new_data[i].MediaTypeId == "2") {
            tr.push('<td>' + "Protected AAC audio file" + '</td>');
            } else if (new_data[i].MediaTypeId == "3"){
            tr.push('<td>' + "Protected MPEG-4 video file" + '</td>');
            } else if (new_data[i].MediaTypeId == "4"){
            tr.push('<td>' + "Purchased AAC audio file" + '</td>');
            } else {
            tr.push('<td>' + "AAC audio file" + '</td>');
            }
            tr.push('<td>'+new_data[i].genre+'</td>');
            tr.push('<td>' + new_data[i].albumTitle + '</td>');
            tr.push('<td><button class=\'edit\'>Edit</button>&nbsp;&nbsp;<button class=\'delete\' id=' + new_data[i].trackId + '>Delete</button></td>');
            tr.push('</tr>');
        }
        $('table').append($(tr.join('')));
        }
    });

});
    
    

    $(document).delegate('#addNew', 'click', function(event) {
        event.preventDefault();
        
        var name = $('#name').val();
        var albumId = $('#albumDrowpdownCreate').val();
        var mediaType = $('#mediaType_Id').val();
        var genreId = $('#genre_Id').val();
        var composer = $('#composer').val();
        var milliseconds = $('#milliseconds').val();
        var bytes = $('#bytes').val();
        var price = $('#price').val();
        
        if(name == null || name == "") {
            alert("Track Name is required");
            return;
        } else if (mediaType == null || mediaType == ""){
            alert("MediaType Id is required")
        } else if(genreId == null || genreId == ""){
            alert("Genre Id is required");
        } else if (composer == null || composer == ""){
            alert("Composer name is required");
        } else if(milliseconds == null || milliseconds == ""){
            alert("Milliseconds is required");
        } else if(bytes == null || bytes == ""){
            alert("Size of file is required");
        } else if(price == null || price == ""){
            alert("Price is required");
        }
        
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: "API/tracks",
            data: JSON.stringify({
                'name': name,
                'album_Id': albumId,
                'mediaType_Id': mediaType,
                'genre_Id': genreId,
                'composer':composer,
                'milliseconds':milliseconds,
                'bytes':bytes,
                'unitPrice':price
            }),
            cache: false,
            success: function(result) {
                alert('Track added successfully');
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
            console.log("TrackId: "+id);
            var parent = $(this).parent().parent();
            $.ajax({
                type: "DELETE",
                url: "API/tracks?id=" + id,
                cache: false,
                success: function(data) {
                    console.log(data);
                    console.log(data.length);
                    console.log(new_data);
                    if(data.length == 234){
                        alert("Cannot Delete purchased tracks");
                        location.reload(true);
                    }else{
                        parent.fadeOut('slow', function() {
                            $(this).remove();
                            location.reload(true)
                            });
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
        var composer = parent.children("td:nth-child(3)");
        var price = parent.children("td:nth-child(4)");
        var mediaType_id = parent.children("td:nth-child(5)");
        var genre_id = parent.children("td:nth-child(6)");
        var buttons = parent.children("td:nth-child(8)");
        
        name.html("<input type='text' id='txtName' value='" + name.html() + "'/>");
        composer.html("<input type='text' id='txtcomposer' value='" + composer.html() + "'/>");
        price.html("<input type='number' id='txtprice' value='" + price.html() + "'/>");
        mediaType_id.html("<select name='mediaType_Id' id='mediaType_Id'>"+
        "<option value='"+1+"'>MPEG audio file</option>"+
        "<option value='"+2+"'>Protected AAC audio file</option>"+
        "<option value='"+3+"'>Protected MPEG-4 video file</option>"+
        "<option value='"+4+"'>Purchased AAC audio file</option>"+
        "<option value='"+5+"'>ACC audio file</option>"+"</select>");
        genre_id.html("<select name='genre_Id' id='genre_Id'>"+
        "<option value='"+1+"'>Rock</option>"+
        "<option value='"+2+"'>Jazz</option>"+
        "<option value='"+3+"'>Metal</option>"+
        "<option value='"+4+"'>Alternative & Punk</option>"+
        "<option value='"+5+"'>Rock And Roll</option>"+
        "<option value='"+6+"'>Blues</option>"+
        "<option value='"+7+"'>Latin</option>"+
        "<option value='"+8+"'>Reggae</option>"+
        "<option value='"+9+"'>Pop</option>"+
        "<option value='"+10+"'>Soundtrack</option>"+
        "<option value='"+11+"'>Bossa Nova</option>"+
        "<option value='"+12+"'>Easy Listening</option>"+
        "<option value='"+13+"'>Heavy Metal</option>"+
        "<option value='"+14+"'>R&B/Soul</option>"+
        "<option value='"+15+"'>Electronica/Dance</option>"+
        "<option value='"+16+"'>World</option>"+
        "<option value='"+17+"'>Hip Hop/Rap</option>"+
        "<option value='"+18+"'>Science Fiction</option>"+
        "<option value='"+19+"'>TV Shows</option>"+
        "<option value='"+20+"'>Sci Fi & Fantasy</option>"+
        "<option value='"+21+"'>Drama</option>"+
        "<option value='"+22+"'>Comedy</option>"+
        "<option value='"+23+"'>Alternative</option>"+
        "<option value='"+24+"'>Classical</option>"+
        "<option value='"+25+"'>Opera</option>"+
        "</select>");
        
        buttons.html("<button id='save'>Save</button>&nbsp;&nbsp;<button class='delete' id='" + id.html() + "'>Delete</button>");
    });
    
    $(document).delegate('#save', 'click', function() {
        var parent = $(this).parent().parent();
        
        var id = parent.children("td:nth-child(1)");
        console.log(id);
        var name = parent.children("td:nth-child(2)");
        var composer = parent.children("td:nth-child(3)");
        var price = parent.children("td:nth-child(4)");
        var mediaType_id = parent.children("td:nth-child(5)");
        var genre_id = parent.children("td:nth-child(6)");
        var buttons = parent.children("td:nth-child(8)");
        
        $.ajax({
            type: "PUT",
            contentType: "application/json; charset=utf-8",
            url: "API/tracks",
            data: JSON.stringify({
                'id' : id.html(),
                'name' : name.children("input[type=text]").val(),
                'composer' : composer.children("input[type=text]").val(),
                'unitPrice' : price.children("input[type=number]").val(),
                'mediaType_Id' : mediaType_id.children('#mediaType_Id').val(),
                'genre_Id' : genre_id.children('#genre_Id').val()


            }),
            cache: false,
            success: function() {
                console.log(id.html());
                console.log(name.children("input[type=text]").val());
                console.log(composer.children("input[type=text]").val());
                console.log(price.children("input[type=number]").val());
                console.log(mediaType_id.children('#mediaType_Id').val());
                console.log(mediaType_id.children('#genre_Id').val());
                name.html(name.children("input[type=text]").val());
                composer.html(composer.children("input[type=text]").val());
                price.html(price.children("input[type=number]").val());
                mediaType_id.html(mediaType_id.children('#mediaType_Id option:selected').val());
                genre_id.html(genre_id.children('#genre_Id option:selected').val());
                location.reload(this);
                buttons.html("<button class='edit' id='" + id.html() + "'>Edit</button>&nbsp;&nbsp;<button class='delete' id='" + id.html() + "'>Delete</button>");
            },
            error: function() {
                alert('Error updating record');
            }
        });
    });

    $.ajax({
        type:"GET",
        url: "API/albums",
        success: function(data){
            data = JSON.parse(data);
            data.forEach(element => {
                $("#albumDrowpdownCreate").append($("<option>", {value: element['albumId'], text: element['title']}));
            })

        }
    });

});