$(document).ready(function() {
    $.ajax({
        url:'/getDataProvince',
        method:'GET',
        type:'json',
        success:function(data){
            $('select[name="province"]').html(` <option value="-1">Select Province</option>`);
            $.each(data, function(id,name) {
                $('select[name="province"]').append('<option value="'+ id +'">'+ name +'</option>');
            });
        }
    })
    $('select[name="province"]').on('change', function() {
    var id = $(this).val();
    var targeturl = '/select/city/'+id;
    if(id == '-1'){
      $('select[name="city"]').html(`<option value="-1">Select City</option>`);
    }else{
		  $.ajax({
              url: targeturl,
              type:'get',
			  dataType: 'json',
			  success:function(data){
                $('select[name="city"]').html(` <option value="-1">Select City</option>`);
                $.each(data, function(id,name) {
                    $('select[name="city"]').append('<option value="'+ id +'">'+ name +'</option>');
                });
                $('select[name="city"]').on('change', function() {
                var no = $(this).val();
                var targetur = '/select/district/'+no;
                if(id == '0'){
                    $('select[name="district_id"]').html(`<option value="-1">Select District</option>`);
                }else{
                    $.ajax({
                        url: targetur,
                        type:'get',
                        dataType: 'json',
                        success:function(data){
                            $('select[name="district_id"]').html(` <option value="-1">Select District</option>`);
                            $.each(data, function(id,name) {
                                $('select[name="district_id"]').append('<option value="'+ id +'">'+ name +'</option>');
                            });
                        }
                    });
                }
                });
			  }
		  });	
	    }
	});
});
