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
    
    var rowsShown = document.getElementById("showRowNumber").innerHTML;
    console.log(rowsShown);
    var rowsTotal = $('#lego_table tbody tr').length;
    var pagesNums = rowsTotal/rowsShown;
    console.log(pagesNums);

    var pageNum = 0;
    var activePage = 1;
    var previousPage = activePage - 1;
    var nextPage = +activePage + 1;

    $('a', $('#lego_dropdown_menu li').find(":contains('" + rowsShown + "')").addClass('active'));

    $('#lego_table_div').after(function () {
        $('#lego_table_div').after("<nav id='pag_nav' aria-label='Page navigation example'>");
        $('#pag_nav').append("<ul class='pagination justify-content-end'>");
        $('.pagination').append("<li id='pag_previous' class='page-item disabled'><a class='page-link' href='#' rel='" + previousPage + "' aria-label='Previous' >&laquo;</a></li>");
        
        for (i=0; i < pagesNums; i++) {
            pageNum = i + 1;
            $('.pagination li:last-of-type').after("<li id='pag_item_" + pageNum + "' class='page-item'><a class='page-link' href='#' rel='" + pageNum + "'>" + pageNum + "</a></li>")
        }
        $('.pagination li:last-of-type').after("<li id='pag_next' class='page-item'><a class='page-link' href='#' rel='" + nextPage + "' aria-label='Previous' >&raquo;</a></li></ul>");
        $('ul').after("</nav>");
    });

    $('#lego_table tbody tr').hide();
    $('#lego_table tbody tr').slice(0, rowsShown).show();
    $('.pagination').css('--bs-pagination-disabled-bg', 'lightgrey');
    $('.pagination').css('--bs-pagination-active-bg', 'rgb(113,187,198)');
    $('.pagination').css('--bs-pagination-active-border-color', 'rgb(113,187,198)');
    $('#pag_previous').addClass('disabled');
    $('#pag_nav ul li:nth-child(2)').addClass('active');
    if ($('#pag_nav ul li').length == 3) {
        $('#pag_next').addClass('disabled');
    }

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
        var endItem = startItem + parseInt(rowsShown, 10);
        console.log('startItem',startItem, 'endItem',endItem);

        $('#lego_table tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).css('display', 'table-row').animate({opacity:1}, 300);

    });

    // $('#lego_search').on('click', function(e) {
    //     console.log('searchValue', searchValue);
    //     console.log('value', $(this).val());
    //     console.log(e);
    //     if ($(this).val() == searchValue) {
    //         console.log('value', $(this).val());
    //         // location.reload();
    //     }
    // });

    $('#lego_search').on('keyup', function () {
        var searchValue = $(this).val().toLowerCase();
        // console.log('this', this);
        console.log('value', searchValue);
        $('#lego_table tr').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1).css('opacity', '1');
        });
        if (searchValue == '') {
            console.log('empty');
            location.reload();
        };
    });

    document.getElementById("lego_search").addEventListener("search", function(event) {
        console.log('clear');  
        location.reload();
    });

    $('#lego_dropdown_menu li').on('click', function(){
        console.log('dropdown');
        rowsShown = $(this).text();
        console.log($(this).text());
        $('#lego_dropdown_menu li a').removeClass('active');
        $('a', this).addClass('active');
        console.log(location.href);
        location.href = 'https://www.smweblou.fr/DEV_SMWEB/public/DB/LEGO/' + rowsShown;

        // $.load('https://www.smweblou.fr/DEV_SMWEB/public/DB/LEGO/5');
        // $(this).children(':first').addClass('active');
        //console.log($('#lego_dropdown_menu li').hasClass('active').text());
    })

});