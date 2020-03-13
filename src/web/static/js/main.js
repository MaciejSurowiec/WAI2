function pob() {
            var t = new Date();
            var m,s;
            var hours = t.getHours();
            var mins = t.getMinutes(); 
            var secs = t.getSeconds();
            if (Number(t.getMinutes() )< 10) m = '0';
            else m = '';

            if (Number(t.getSeconds()) < 10) s = '0';
            else s = '';
            
            document.getElementById("czas").innerHTML = + hours + ":" + m+mins + ":" +s+ secs;
}

function OnLoad() {

    if (!sessionStorage.getItem("pelno") && !localStorage.getItem("pel")) {

        $("#dial").addClass("pok");
        var dial = document.getElementById("dial");
        var Di = $("<div></div>").attr("id", "dialog");
        $(Di).attr("title", "Czy masz skończone 18 lat?");
        $("#dial").append(Di);
   
        $("#dialog").dialog({
            open: true,
            closeOnEscape: false,
            hide: { effect: "fold", duration: 500 },
            draggable: false,
            width: 400,
            resizable: false,
            create: function (e, ui) {
                var pane = $(this).dialog("widget").find(".ui-dialog-buttonpane")
                $("<label class='container' >Zapamiętaj mnie na tej stornie!<input  type='checkbox'/> <span class='checkmark'><span/></label>").prependTo(pane)
            },
            buttons: [
                {
                    text: "Tak",
                    click: function () {
                        sessionStorage.setItem("pelno", true)
                        $("#dial").removeClass("pok");
                        if ($("#check").val()) {
                            localStorage.setItem("pel",true)
                        }

                        $(this).dialog("close");
                    }
                },
                {
                    text: "Nie",
                    click: function () {
                        $(this).dialog("close");
                        window.location.href = "https://www.google.pl";
                    }
                }
            ]
        });
    }
}


window.addEventListener('load', function () {
  


    $(function () {
    $("#rozwin").addClass("roz");
    $("#menu").menu();
    
});

setInterval(pob, 1000);
OnLoad();

    
})




