"use strict";

$(function () {
  apsTable();
});

function apsTable() {
  if (document.getElementById("apsTable")) {
    const acciones = (data, type, row) => {
      return `
      <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-primary btn-sm mr-1" data-toggle="modal" data-target="#modalEditarRol" onclick="editarRol(${row.id_aps})"><i class="fas fa-edit"></i></button>
        <button type="button" class="btn btn-danger btn-sm mr-1" onclick="eliminarRol(${row.id_aps})"><i class="fas fa-trash"></i></button>
      </div>
      `;
    };

    const estatus = (data, type, row) => {
      if (row.estatus_aps == `ACTIVO`) {
        return `<span class="badge badge-success">${row.estatus_aps}</span>`;
      } else {
        return `<span class="badge badge-danger">${row.estatus_aps}</span>`;
      }
    };

    $("#apsTable").DataTable({
      responsive: false,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Buscar...",
        lengthMenu: "Mostrar _MENU_ entradas",
        zeroRecords: "No hay entradas",
        info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
        infoEmpty: "No hay entradas",
        infoFiltered: "(filtrado de _MAX_ entradas totales)",
        paginate: {
          first: "Primero",
          last: "Último",
          next: "Siguiente",
          previous: "Anterior",
        },
      },
      ajax: {
        url: "../aps/listapsjson",
        dataSrc: "",
      },
      columns: [
        { data: "id_aps" },
        { data: "nombre" },
        { data: "estatus_aps", render: estatus },
        { data: "fecha_reg" },
        { data: null, render: acciones },
      ],
    });
  }
}

function guardarRol() {
  let nombre = document.getElementById("nombre").value;
  let data = {
    nombre: nombre,
  };
  $.ajax({
    url: "aps/aps",
    type: "POST",
    data: JSON.stringify(data),
    contentType: "application/json",
    success: function (response) {
      console.log(response);
    },
  });
}
