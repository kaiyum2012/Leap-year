$('#btn-date-history').on('click',function(event){
    event.preventDefault();
    console.log("history");
    $.ajax({
        url: "/date/history",
        type:"GET",
        data:{
            "_token": "{{ csrf_token() }}",
        },
        success:function(response){
            console.log(response);
            let result = JSON.parse(response);
            if(result['success']){
                let x = `<div class="card" style="width: 18rem;">
                            <div class="card-body">
<h5 class="card-title">Card title</h5>
<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
<a href="#" class="btn btn-primary">Go somewhere</a>
</div>
</div>`;
               $('div.history #records').html("<p class='alert alert-success'> difference in days =" + result['days'] + "</p>");
            }
        },
        error:function(response){
            // Default response HTTP 422 from laravel on form validation error
            if(response.status == 422){
                let x = JSON.parse(response.responseText);
                let errors = x['errors'];
                $('div.flash-message').html("")
                $.each(errors, function (key, value) {
                    $('div.flash-message').append("<p class='alert alert-danger'>"+ value +"</p>");
                });
            }
        }
    });
});