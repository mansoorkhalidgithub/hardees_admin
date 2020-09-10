$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	
	
$(document).ready(function() {
    $("#search").on("keyup", function() {
        $value = $(this).val();
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "post",
            url: "search",
            data: {
                search: $value
            },
            success: function(data) {
                $("tbody").html(data);
            }
        });
    });
});
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $("body").on("click", "#edit_category", function() {
        var cat_id = $(this).data("id");
        $.get("/category/" + "edit/" + cat_id, function(data) {
            console.log(data);
            $("#update_category").modal("show");
            $("#cat_id1").val(data.id);
            $("#title1").val(data.title);
            $("#description1").val(data.description);
        });
    });

    $("body").on("click", ".del_category", function() {
        var cat_id = $(this).data("id");
        if (confirm("Are You sure want to delete !")) {
            $.ajax({
                type: "delete",
                url: "/category/" + cat_id,
                success: function(data) {
                    console.log(data);
                    $("#category_" + cat_id).remove();
                },
                error: function(data) {
                    console.log("Error:", data);
                }
            });
        }
    });
});

var timing = 1;
function timing_fields() {
    console.log("fff");
    timing++;
    var objTime = document.getElementById("timing_fields");
    var ItemTime = document.getElementById("time");
    var ItemFromTime = document.getElementById("time_from");
    var ItemToTime = document.getElementById("time_to");
    var itemDataTime = ItemTime.value;
    var itemDataFromTime = ItemFromTime.value;
    var itemDataToTime = ItemToTime.value;
    //alert(itemDataTime+" "+itemDataFromTime+" "+itemDataToTime);
    var divtest = document.createElement("div");
    divtest.setAttribute(
        "class",
        "row form-group category-table removeTimeclass" + timing
    );
    var rdiv = "removeTimeclass" + timing;
    divtest.innerHTML =
        '<div class="col-sm-5"><div class="form-group"><input type="text" class="form-control" id="restaurant_time" value ="' +
        itemDataTime +
        '"  name="restaurant_timing[] placeholder="e.g {3} Tea Spoon Honey "> </div></div><div class="col-sm-3"><div class="form-group"> <input type="time" class="form-control" id="restaurant_from_time" value ="' +
        itemDataFromTime +
        '"  name="restaurant_from_timing[] placeholder="e.g {3} Tea Spoon Honey "></div></div> <div class="col-sm-3"><div class="form-group"><input type="time" class="form-control" id="restaurant_to_time" value ="' +
        itemDataToTime +
        '"  name="restaurant_to_timing[] placeholder="e.g {3} Tea Spoon Honey "> </div></div>   <div class="col-sm-1 nopadding"><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_timing_fields(' +
        timing +
        ');"> <i class="fas fa-minus"></i> </button></div></div></div>';
    ItemTime.value = "";
    ItemFromTime.value = "";
    ItemToTime.value = "";
    objTime.appendChild(divtest);
}
function remove_timing_fields(rid) {
    $(".removeTimeclass" + rid).remove();
}
var room = 1;
function restaurantCategories() {
    room++;
    var objTo = document.getElementById("restaurant_categories");
    var Item = document.getElementById("item");
    var itemData = Item.value;
    //alert(itemData);
    var divtest = document.createElement("div");
    divtest.setAttribute(
        "class",
        "row form-group category-table removeclass" + room
    );
    var rdiv = "removeclass" + room;
    divtest.innerHTML =
        '<div class="col-sm-11 nopadding"><div class="form-group"><input type="text" class="form-control" id="categories" value ="' +
        itemData +
        '"  name="categories[]" placeholder="e.g {3} Tea Spoon Honey "></div></div> <div class="col-sm-1 nopadding"><div class="input-group-btn"> <button class="btn btn-danger" type="button" onclick="remove_education_fields(' +
        room +
        ');"> <i class ="fas fa-minus"></i> </button></div></div>';
    Item.value = "";
    objTo.appendChild(divtest);
}
function remove_education_fields(rid) {
    $(".removeclass" + rid).remove();
}
