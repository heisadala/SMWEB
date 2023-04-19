$(document).ready(function () {

    $('tr').click(function() {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
            document.getElementById("primaryKey").innerHTML = 'primaryKey';
        }
        else {
            $(this).addClass('selected').siblings().removeClass('selected');
            cells = $(this).find('td');
            reference=document.getElementById("primaryKeyPlace").innerHTML;
            selected_ref = cells.eq(reference - 1).html();
            document.getElementById("primaryKey").innerHTML = selected_ref.replace(/\s/g, '');
        }
    });

    // var $pagination = $("<ul class='pagination'>
    // <li class='page-item'><a class='page-link' href='#'>Previous</a></li>
    //     <li class='page-item'><a class='page-link' href='#'>1</a></li>
    //     <li class='page-item'><a class='page-link' href='#'>2</a></li>
    //     <li class='page-item'><a class='page-link' href='#'>3</a></li>
    //     <li class='page-item'><a class='page-link' href='#'>Next</a></li>
    //     </ul>");
    
    var rowsShown = 10;
    var rowsTotal = $('#lego_table tbody tr').length;
    var pagesNums = rowsTotal/rowsShown;
    console.log(pagesNums);

    var pageNum = 0;
    var activePage = 1;
    var previousPage = activePage - 1;
    var nextPage = +activePage + 1;

    $('#lego_table_div').after(function () {
        $('#lego_table_div').after("<nav id='pag_nav' aria-label='Page navigation example'>");
        $('#pag_nav').append("<ul class='pagination justify-content-end'>");
        $('.pagination').append("<li id='pag_previous' class='page-item disabled'><a class='page-link' href='#' rel='" + previousPage + "'>Previous</a></li>");
        
        for (i=0; i < pagesNums; i++) {
            pageNum = i + 1;
            $('li:last-of-type').after("<li id='pag_item_" + pageNum + "' class='page-item'><a class='page-link' href='#' rel='" + pageNum + "'>" + pageNum + "</a></li>")
        }
        $('li:last-of-type').after("<li id='pag_next' class='page-item'><a class='page-link' href='#' rel='" + nextPage + "'>Next</a></li></ul>");
        $('ul').after("</nav>");
    });

    $('#lego_table tbody tr').hide();
    $('#lego_table tbody tr').slice(0, rowsShown).show();
    $('.pagination').css('--bs-pagination-disabled-bg', 'lightgrey');
    $('#pag_previous').addClass('disabled');
    $('#pag_nav ul li:nth-child(2)').addClass('active');


    $('#pag_nav a').bind('click', function () {
        $('#pag_nav ul li').removeClass('active');
        $('#pag_nav ul li').removeClass('disabled');
        activePage = $(this).attr('rel');

        console.log('parent', $(this).parent())
        $(this).parent().addClass('active');
        $('#pag_item_' + activePage).addClass('active');

        console.log('pagenum', pageNum, 'activepage', activePage);

        previousPage = activePage - 1;
        nextPage = +activePage + 1;
        console.log('previouspage',previousPage, 'nextpage',nextPage);

        $('#pag_previous a').attr('rel', previousPage);
        $('#pag_next a').attr('rel', nextPage);

        if (previousPage == 0) {
            $('#pag_previous').addClass('disabled');
        }

        if (nextPage > pageNum) {
            $('#pag_next').addClass('disabled');
        }

        var startItem = (activePage - 1) * rowsShown;
        var endItem = startItem + rowsShown;
        console.log('startItem',startItem, 'endItem',endItem);

        $('#lego_table tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).css('display', 'table-row').animate({opacity:1}, 300);

    });
    
});