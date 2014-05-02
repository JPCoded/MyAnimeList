 $(document).ready(function(){
           $("#completed tr:odd").addClass("odd");
           $("#completed tr:not(.odd)").hide();
           $("#completed tr:first-child").show();

           $("#watching tr:odd").addClass("odd");
           $("#watching tr:not(.odd)").hide();
           $("#watching tr:first-child").show();

           $("#ptw tr:odd").addClass("odd");
           $("#ptw tr:not(.odd)").hide();
           $("#ptw tr:first-child").show();

           $("#onhold tr:odd").addClass("odd");
           $("#onhold tr:not(.odd)").hide();
           $("#onhold tr:first-child").show();

           $("#completed tr.odd").click(function(){
                $(this).next("tr").toggle();
                $(this).toggleClass("nod");
                $(this).find(".arrow").toggleClass("up");
            });


            $("#watching tr.odd").click(function(){
                $(this).next("tr").toggle();
                $(this).toggleClass("nod");
                $(this).find(".arrow").toggleClass("up");
            });

            $("#ptw tr.odd").click(function(){
                $(this).next("tr").toggle();
                $(this).toggleClass("nod");
                $(this).find(".arrow").toggleClass("up");
            });

            $("#onhold tr.odd").click(function(){
                $(this).next("tr").toggle();
                $(this).toggleClass("nod");
                $(this).find(".arrow").toggleClass("up");
            });
        });