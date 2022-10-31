function update() { //給予獎懲的選單
    var select = document.getElementById("reason"); //定義select，方便之後取值
    var option = select.options[select.selectedIndex].text; //將option的值存起來
    document.getElementById("Textarea1").value += option;
}

function deleteSelect() { //給予獎懲的選單
    var select = document.getElementById("reason"); //定義select，方便之後取值
    var option = select.options[select.selectedIndex].text; //將option的值存起來
    document.getElementById("Textarea1").value += option;
}

function addSelect() { //給予獎懲的選單
    var reason = document.getElementById("reason"); //定義select
    var inputSelect = document.getElementById("inputSelect"); //定義input
    var str = "";
    var submitValue = inputSelect.value;
    str = submitValue; //str=input值

    var option = document.createElement("option");
    option.text = str;
    reason.add(option);
}