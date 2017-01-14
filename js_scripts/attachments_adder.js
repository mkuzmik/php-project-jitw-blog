/**
 * Created by M.Kuzmik on 13.01.2017.
 */


function createFileInput() {
    var input = document.createElement("input");
    input.type = "file";


    var id = document.getElementById("attachmentsContainer").childNodes.length / 2;
    input.name = "file".concat(id.toString());

    document.getElementById("attachmentsContainer").appendChild(input);
    document.getElementById("attachmentsContainer").appendChild(document.createElement("br"));
}

