function getPurchaseOrderCharts(URL){
    console.log(URL);
    $.ajax({
        url: URL,
        dataType: 'json',
        async:false,
        success: function (data) {

            var date = data.date;
            var value = data.prquisition;
            Index.initCharts();
        }
    });



}