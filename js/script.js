
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox({alwaysShowClose: true});
});

function vote(number) {
    $.ajax({
        type: 'POST',
        url: 'backend/movieVote.php',
        data: { vote : number },
        success: function(data) {
            //var data = JSON.parse(data)
            console.log(data)
        }
    })
}

$(document).ready(function() {
    $('#get').click(function() {
        $.ajax({
            type: 'GET',
            url: 'backend/movieVote.php',
            success: function(data) {
                var data = JSON.parse(data)
                $('#response').append('A face da água: ' + data.filme01 + ' votos' + '<br />')
                $('#response').append('Três Soluções: ' + data.filme02 + ' votos' + '<br />')
                $('#response').append('Dumkilo: ' + data.filme03 + ' votos' + '<br />')
                $('#response').append('O inhame que a gente come: ' + data.filme04 + ' votos' + '<br />')
                $('#response').append('Colha!: ' + data.filme05 + ' votos')
            }
        })
    })
})
