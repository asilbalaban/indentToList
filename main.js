$(document).ready(function(){
    // set textarea's width & height
    var totalHeight = $(window).height();
    var totalWidth = $(window).width();
    $('.box, .output').height((totalHeight)-10);
    $('.box, .output').width((totalWidth/2)-5); 

    // add line numbers
    $(".box").linedtextarea();

    // encode
    $('#input').bind('input propertychange', function() {
        var input = $('#input').val();
        $.ajax({
            method: 'post',
            url : 'generator.php',
            data : { 'input':input }, 
            success : function(cevap) {
                $('#output').html(cevap);  

                toplam = $('#output li + ul').size();
                for ( i=0; i<toplam; i++ ) {
                    
                }
            }
        });        
    })     

    // handle tab key
    $("textarea").keydown(function(e) {
        if(e.keyCode === 9) { // tab was pressed
            // get caret position/selection
            var start = this.selectionStart;
            var end = this.selectionEnd;

            var $this = $(this);
            var value = $this.val();

            // set textarea value to: text before caret + tab + text after caret
            $this.val(value.substring(0, start)
                        + "\t"
                        + value.substring(end));

            // put caret at right position again (add one for the tab)
            this.selectionStart = this.selectionEnd = start + 1;

            // prevent the focus lose
            e.preventDefault();
        }
    });    
});     