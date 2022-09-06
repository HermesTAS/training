<?php
require_once "core/init.php";

$pelanggan = read();
require_once "view/header.php";
?>

<table id="grid" class="scroll"  cellpadding="0" cellspacing="0" width="80%"></table>
<div id="pager"></div>

<script>
$("#grid").jqGrid({
    url: "datatable.php",
    datatype: "json",
    mtype: "GET",
    ajaxGridOptions: { contentType: "application/json" },
    editurl: 'crud-function.php',
    colNames: [
        "No Faktur",
        "Tanggal Faktur",
        "Nama Pelanggan",
        " "
    ],
    colModel: [
        {name: 'nofaktur',edittype:"text" ,editable: true, width:100, label : 'No Faktur'},
        {name: 'tanggalfaktur',edittype:"date" ,editable: true, width:100, label : 'Tanggal Faktur'},
        {name: 'namapelanggan',edittype:"text" ,editable: true, width:100, label : 'Nama Pelanggan'},
        {name: 'link', label : ' '}
    ],
    pager: '#pager',
    page:1,
height: '100%',
autowidth: true,
    pgbuttons	:true,
    rowNum: 4,
    rowList: [4, 20],
    sortname: "nofaktur",
    sortorder: "asc",
    height: 'auto',
    viewrecords: true,
    sortable:true, //sort
    rownumbers: true, //row numbers on left
    // multiselect: true, //check box
    // height: '100%', //height: 'auto',
    gridview: true,
    caption: "sadasd",
    editable: true
});
//

$("#grid").jqGrid('navGrid','#pager',{
        edit:true, edittitle: "Edit Post", width: 500,
        add:true, addtitle: "Add Post", width: 500,
        del:true,
        view:true,
        search: true
    },
    // prmEdit
    {
        editCaption: "Edit Post",
        edittext: "Edit",
        closeOnEscape: true,
        closeAfterEdit: true,
        savekey: [true, 13],
        errorTextFormat: commonError,
        width: "500",
        reloadAfterSubmit: true,
        bottominfo: "Fields marked with (*) are required",
        top: "60",
        left: "5",
        right: "5",
        onclickSubmit: function (response, postdata) {
            $(this).setGridParam({datatype:'json', multiselect: true, loadonce:false, reloadAfterSubmit:true});
            $(this).setGridParam({loadonce:true});
            // EditComment(postdata);
        }
    },
    //Add data
    {
        addCaption: "Add Post",
        addtext: "Add",
        closeOnEscape: true,
        closeAfterAdd: true,
        savekey: [true, 13],
        errorTextFormat: commonError,
        width: "500",
        reloadAfterSubmit: true,
        bottominfo: "Fields marked with (*) are required",
        top: "60",
        left: "5",
        right: "5",
        onclickSubmit: function (response, postdata) {
            $(this).setGridParam({datatype:'json', multiselect: true, loadonce:false, reloadAfterSubmit:true});
            $(this).setGridParam({loadonce:true});
        }
    },
    // prmDel
    { },
    {
        // prmSearch
    },
    {
        // prmView
    }
);

function commonError() {
    return "Error Occured during Operation. Please try again";
}
// function AddPost(params) {
//     $.ajax({
//         url: 'crud-function.php',
//         type: 'post',
//         data:params,
//         success: function(data) {
//             console.log(params);
//             return data;
//         }
//     });
// }
// function EditComment(params) {
//     console.log(params);
// }
// function DeletePost(params) {
//     console.log(params);
// }

</script>
<?php require_once "view/footer.php"; ?>
