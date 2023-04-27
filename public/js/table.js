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

    var rowsShown = document.getElementById("showRowNumber").innerHTML;
    console.log(rowsShown);

    var rowsTotal = $('#sm-body-lego-table-table tbody tr').length;
    var pagesNums = rowsTotal/rowsShown;
    console.log(pagesNums);

    var pageNum = 0;
    var activePage = 1;
    var previousPage = activePage - 1;
    var nextPage = +activePage + 1;

    $('a', $('#sm-body-lego-table-table-dropdown-menu li').find(":contains('" + rowsShown + "')").addClass('active'));

    $('#sm-body-lego-table-table').after(function () {
        $('#sm-body-lego-table-table').after("<nav id='sm-body-lego-table-table-pag-nav' aria-label='Page navigation example'>");
        $('#sm-body-lego-table-table-pag-nav').append("<ul class='pagination justify-content-end'>");
        $('.pagination').append("<li id='sm-body-lego-table-table-pag-previous' class='page-item disabled'><a class='page-link' href='#' rel='" + previousPage + "' aria-label='Previous' >&laquo;</a></li>");
        
        for (i=0; i < pagesNums; i++) {
            pageNum = i + 1;
            $('.pagination li:last-of-type').after("<li id='sm-body-lego-table-table-pag-item-" + pageNum + "' class='page-item'><a class='page-link' href='#' rel='" + pageNum + "'>" + pageNum + "</a></li>")
        }
        $('.pagination li:last-of-type').after("<li id='sm-body-lego-table-table-pag-next' class='page-item'><a class='page-link' href='#' rel='" + nextPage + "' aria-label='Previous' >&raquo;</a></li></ul>");
        $('ul').after("</nav>");
    });

    $('#sm-body-lego-table-table tbody tr').hide();
    $('#sm-body-lego-table-table tbody tr').slice(0, rowsShown).show();
    $('.pagination').css('--bs-pagination-disabled-bg', 'lightgrey');
    $('.pagination').css('--bs-pagination-active-bg', 'rgb(113,187,198)');
    $('.pagination').css('--bs-pagination-active-border-color', 'rgb(113,187,198)');
    $('#sm-body-lego-table-table-pag-previous').addClass('disabled');
    $('#sm-body-lego-table-table-pag-nav ul li:nth-child(2)').addClass('active');
    if ($('#sm-body-lego-table-table-pag-nav ul li').length == 3) {
        $('#sm-body-lego-table-table-pag-next').addClass('disabled');
    }

    $('#sm-body-lego-table-table-pag-nav a').bind('click', function () {
        $('#sm-body-lego-table-table-pag-nav ul li').removeClass('active');
        $('#sm-body-lego-table-table-pag-nav ul li').removeClass('disabled');
        activePage = $(this).attr('rel');

        console.log('parent', $(this).parent())
        $(this).parent().addClass('active');
        $('#sm-body-lego-table-table-pag-item-' + activePage).addClass('active');

        console.log('pagenum', pageNum, 'activepage', activePage);

        previousPage = activePage - 1;
        nextPage = +activePage + 1;
        console.log('previouspage',previousPage, 'nextpage',nextPage);

        $('#sm-body-lego-table-table-pag-previous a').attr('rel', previousPage);
        $('#sm-body-lego-table-table-pag-next a').attr('rel', nextPage);

        if (previousPage == 0) {
            $('#sm-body-lego-table-table-pag-previous').addClass('disabled');
        }

        if (nextPage > pageNum) {
            $('#sm-body-lego-table-table-pag-next').addClass('disabled');
        }

        var startItem = (activePage - 1) * rowsShown;
        var endItem = startItem + parseInt(rowsShown, 10);
        console.log('startItem',startItem, 'endItem',endItem);

        $('#sm-body-lego-table-table tbody tr').css('opacity', '0.0').hide().slice(startItem, endItem).css('display', 'table-row').animate({opacity:1}, 300);

    });

    $('#sm-body-lego-table-table-search').on('keyup', function () {
        var searchValue = $(this).val().toLowerCase();
        // console.log('this', this);
        console.log('value', searchValue);
        $('#sm-body-lego-table-table tr').filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(searchValue) > -1).css('opacity', '1');
        });
        if (searchValue == '') {
            console.log('empty');
            location.reload();
        };
    });

    document.getElementById("sm-body-lego-table-table-search").addEventListener("search", function(event) {
        console.log('clear');  
        location.reload();
    });

    $('#sm-body-lego-table-table-dropdown-menu li').on('click', function(){
        console.log('dropdown');
        rowsShown = $(this).text();
        console.log($(this).text());
        $('#sm-body-lego-table-table-dropdown-menu li a').removeClass('active');
        $('a', this).addClass('active');
        console.log(location.host);
        location.href = 'https://' + location.host + '/DEV_SMWEB/public/DB/LEGO/HOME/' + rowsShown;

    });

    document.getElementById("sm-body-lego-navbar-link-delete-img").addEventListener("click", function(event) {
        if (document.getElementById("primaryKey").innerHTML == 'primaryKey') {
            alert("NOTHING SELECTED")
        }
        else {
	        var reference=document.getElementById("primaryKey").innerHTML
            var name=document.getElementById("primaryKeyName").innerHTML;

	        // var language=document.getElementById("language").innerHTML
	        // var originSite=document.getElementById("originSite").innerHTML
            console.log("***" + reference + '****');
            console.log("***" + name + '****');
            // console.log(originSite + "/public/Delete_form.php?Ref=" + reference)
             // window.open(originSite + '/public/Delete_form.php?lang=' + language + '&Ref=' + reference, '_blank').focus;
             console.log("https://www.smweblou.fr/DEV_SMWEB/public/DB/LEGO/DELETE/" + name + '/' + reference)
             // location.href = 'https://' + location.host + '/DEV_SMWEB/public/DB/LEGO/HOME/' + rowsShown;
             window.open('https://' + location.host + '/DEV_SMWEB/public/DB/LEGO/DELETE/' + name + '/' + reference, '_blank').focus;
        }
    });
});