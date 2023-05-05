$(document).ready(function () {


    $('.card').click(function() {
        if ( $(this).find('.card-body').hasClass('card-selected') ) {
            $(this).find('.card-body').removeClass('card-selected');
            $(this).find('.card-body').removeClass('text-bg-warning');
            document.getElementById("primaryKey").innerHTML = 'primaryKey';
        }
        else {
            console.log('selected: ', $('div').siblings('.card-body'));
            $('div').siblings('.card-body').removeClass('selected');
            $('div').siblings('.card-body').removeClass('text-bg-warning');
            $(this).find('.card-body').addClass('card-selected');
            $(this).find('.card-body').addClass('text-bg-warning');
            cardNumber = $(this).find('.sm-gallery-card-pk').text();
            console.log('cardNumber', $(this).find('.sm-gallery-card-pk').text());
            pkName = document.getElementById("primaryKeyName").innerHTML
            console.log('pkName', document.getElementById("primaryKeyName").innerHTML);
            console.log('selected ref', $(this).find('#sm-gallery-card-' + pkName + '-' + cardNumber).text());
            selected_ref = $(this).find('#sm-gallery-card-' + pkName + '-' + cardNumber).text()
            document.getElementById("primaryKey").innerHTML = selected_ref.replace(/\s/g, '');
        }
    });

    $('#sm-lego-table-search-input').on('keyup', function () {
        var searchValue = $(this).val().toLowerCase();
        console.log('value', searchValue);

        $('.sm-lego-gallery div').filter(function () {
            if ($(this).text().toLowerCase().indexOf(searchValue) == -1) {
                console.log('gallery ', $(this), ' hide');
                $(this).hide();
            }
            if ($(this).text().toLowerCase().indexOf(searchValue) > -1) {
                console.log('gallery ', $(this), 'show');
                $(this).show();
            }
        });
        if (searchValue == '') {
            console.log('empty');
            location.reload();
        };
    });

    document.getElementById("sm-lego-table-search-input").addEventListener("search", function(event) {
        console.log('clear');  
        location.reload();
    });


    document.getElementById("sm-lego-navbar-link-delete-img").addEventListener("click", function(event) {
        if (document.getElementById("primaryKey").innerHTML == 'primaryKey') {
            alert("NOTHING SELECTED")
        }
        else {
	        var reference=document.getElementById("primaryKey").innerHTML
            var name=document.getElementById("primaryKeyName").innerHTML;
            var pathname='HOME';

	        // var language=document.getElementById("language").innerHTML
	        // var originSite=document.getElementById("originSite").innerHTML
            console.log("***" + reference + '****');
            console.log("***" + name + '****');
            // console.log(originSite + "/public/Delete_form.php?Ref=" + reference)
             // window.open(originSite + '/public/Delete_form.php?lang=' + language + '&Ref=' + reference, '_blank').focus;
            console.log(location)
             // location.href = 'https://' + location.host + '/DEV_SMWEB/public/DB/LEGO/HOME/' + rowsShown;
             pathname = location.href.substring(0,location.href.indexOf('HOME'));
             console.log(pathname);
             window.open(pathname + 'DELETE/' + name + '/' + reference, '_blank').focus;
         }
    });

    document.getElementById("sm-lego-navbar-link-edit-img").addEventListener("click", function(event) {
        if (document.getElementById("primaryKey").innerHTML == 'primaryKey') {
            alert("NOTHING SELECTED")
        }
        else {
	        var reference=document.getElementById("primaryKey").innerHTML
            var name=document.getElementById("primaryKeyName").innerHTML;
            var pathname='HOME';

	        // var language=document.getElementById("language").innerHTML
	        // var originSite=document.getElementById("originSite").innerHTML
            console.log("***" + reference + '****');
            console.log("***" + name + '****');
            console.log(location)
             // location.href = 'https://' + location.host + '/DEV_SMWEB/public/DB/LEGO/HOME/' + rowsShown;

            pathname = location.href.substring(0,location.href.indexOf('HOME'));
            console.log(pathname);
            window.open(pathname + 'EDIT/' + name + '/' + reference, '_blank').focus;
        }
    });
});