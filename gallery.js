const { response } = require("express");

const folderPath = "Assets/";
//fetch the list of files in the folder
fetch(folderPath)
  .then((response) => response.text())
  .then((data) => {
    const parser = new DOMParser();
    const doc = parser.parseFromString(data, "text/html");
  });
