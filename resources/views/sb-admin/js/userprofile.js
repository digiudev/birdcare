/**
 * Created by root on 29/12/15.
 */

UserProfile = {

    getLocation: function()
        {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(UserProfile.savePosition, UserProfile.positionError, {timeout: 2000});
            } else {
                //Geolocation is not supported by this browser
            }
        },

        // handle the error here
    positionError: function(error) {
            var errorCode = error.code;
            var message = error.message;

            alert(message);
        },

    savePosition: function(position) {

        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        var dati = $("#form-user-profile").serialize() + '&lat='+lat+'&lng='+lng;
        $.ajax({
            type: "POST",
            url: "/admin/mylocation",
            data: dati, // serializes the form's elements.
            success: function (data) {
                var dati = $.parseJSON(data);
                UserProfile.updateFieldByName('city', dati.city);
                UserProfile.updateFieldByName('province', dati.province);
                UserProfile.updateFieldByName('zip', dati.zip);
                UserProfile.updateFieldByName('address', dati.address);
                UserProfile.updateSelect('id_country', dati.id_country)
            }
        });
    },

    updateFieldByName: function(nome, val){
        if(val!='')
            $("input[name="+nome+"]").val(val);
    },

    updateSelect: function(id, val)
    {
        if(val!='')
            $("#"+id).val(val);
    }

}