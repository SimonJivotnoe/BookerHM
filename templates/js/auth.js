$( document ).ready( function ()
{
    $('.buttonSignIn').on('click', function(){
        $('.loginERR, .passERR, .noUser').html('');
        checkInputs('index.php?page=ajaxauthctrl')
    })
})
