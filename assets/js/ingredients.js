$(document).ready(function(){
    var next = 1;
    $(".add-more").click(function(e){
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = '<p style="text-align:center">Étape '+next+'</p><textarea rows="8" cols="50" autocomplete="off" class="inputE" id="field' + next + '" name="profEt[]" type="text"  maxlength="20000" placeholder="Étape '+next+' " required>';
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    });

    var nextIng = 1;
    $(".add-more-ing").click(function(e){
        e.preventDefault();
        var addto = "#fieldIng" + nextIng;
        var addRemove = "#fieldIng" + (nextIng);
        nextIng = nextIng + 1;
        var newIn = '<input autocomplete="off" class="inputI" id="fieldIng' + nextIng + '" name="profIng[]" type="text" maxlength="20" placeholder="Cantité-Unité-Ingredient (Ex1: 200-g-sucre Ex2: 3-cuillere-sel)" required >';
        var newInput = $(newIn);
        var removeBtn = '<button id="removeIng' + (nextIng - 1) + '" class="btn btn-danger remove-me-ing" >-</button></div><div id="fieldIng">';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#fieldIng" + nextIng).attr('data-source',$(addto).attr('data-source'));
        $("#countIng").val(nextIng);  
        
            $('.remove-me-ing').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#fieldIng" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
                
            });
    });

    var nextUt = 1;
    $(".add-more-ut").click(function(e){
        e.preventDefault();
        var addto = "#fieldUt" + nextUt;
        var addRemove = "#fieldUt" + (nextUt);
        nextUt = nextUt + 1;
        var newIn = '<input autocomplete="off" class="inputU" id="fieldUt' + nextUt + '" name="profUt[]" type="text" maxlength="20" placeholder="Utensille '+nextUt+'" required>';
        var newInput = $(newIn);
        var removeBtn = '<button id="removeUt' + (nextUt - 1) + '" class="btn btn-danger remove-me-ut" >-</button></div><div id="fieldUt">';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#fieldUt" + nextUt).attr('data-source',$(addto).attr('data-source'));
        $("#countUt").val(nextUt);  
        
            $('.remove-me-ut').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#fieldUt" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
    });
    
    $(".register").click(function(){
           
            
            var diffValue = $("input[name='diff']:checked").val();
            if(diffValue){
                document.getElementById("diffid").value = diffValue;
            }
            var coutValue = $("input[name='cout']:checked").val();
            if(coutValue){
                document.getElementById("coutid").value = coutValue;
            }
            
            var elements = document.getElementsByClassName("inputI");
            var ing = '';
            for(var i=0; i<elements.length; i++) {
                ing += elements[i].value+"{";
            }
            document.getElementById("ing").value = ing;

            elements = document.getElementsByClassName("inputU");
            var ut = '';
            for(var i=0; i<elements.length; i++) {
                ut += elements[i].value+"{";
            }
            document.getElementById("ut").value = ut;

            elements = document.getElementsByClassName("inputE");
            var et = '';
            for(var i=0; i<elements.length; i++) {
                et += elements[i].value+"{";
            }
            document.getElementById("et1").value = et;
    });



    
});
