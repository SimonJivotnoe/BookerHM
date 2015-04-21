$( document ).ready( function ()
{
    $('.glyphicon-remove').on('click', function(){
          var userId = $(this ).attr('name');
        if (confirmDelete()) {
            deleteUser('index.php?page=deleteuser&userId=', userId);
        }
    })

    $('.newUserButton').on('click', function(){
        newUser('index.php?page=newUser');
    })
});
