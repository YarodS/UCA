var xD = {
  all: {
    fn0: function () {
      $("#generar").on({
        click: function (e) {
          if ($("#cbo_customers").val() == "") {
            e.preventDefault();
            $("#cbo_customer-box").addClass(" has-error");
          }
        },
      });
      $("#cbo_customers").on({
        change: function () {
          $("#cbo_customer-box").removeClass(" has-error");
          if ($(this).val() === "ZTE") {
            $(".box-form-i").show();
            $("#cdo_i").removeAttr("disabled", true);
          } else {
            $(".box-form-i").hide();
            $("#cdo_i").attr("disabled", "disabled");
          }
        },
      });
    },
    fn1: function () {
      $(".pull-error").show().fadeOut(5000);
    },
    fnmodalview: function () {
      $(".box_positions").on({
        click: function () {
          var pp1 = $(this).data("type");
          var pp2 = $(this).data("nave");
          let pp3 = $(this).data("layout");
          let typepos = pp1 == "P" ? "" : pp1;
          var lll1 = "";
          $.getJSON(
            "Cls_Datos/Json.php",
            {
              page: "MyAnalytics",
              action: "MyAnalytics",
              method: "uca_get_position_libres_nave_tp",
              p_type_post: typepos,
              p_nave: pp2,
              p_lay_out: pp3,
            },
            function (pppp1) {
              lll1 += '<div class="modal-header">';
              lll1 +=
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
              lll1 +=
                '<a href="exportPositionLibre.php?lay_out=' +
                pp3 +
                "&type=" +
                typepos +
                "&nave=" +
                pp2 +
                '" class="btn btn-success btn-sm pull-right" title="Exportar a Excel">Exportar<i class="fo-icon glyphicon glyphicon-list-alt closed"></i></a>';
              lll1 +=
                '<h4 class="modal-title" id="myModalLabel">Lista de Posiciones de ' +
                (pp1 == "P" ? "PISO M2" : pp1) +
                " Nave " +
                pp2 +
                "</h4>";
              lll1 += "</div>";
              lll1 += '<div class="modal-body">';
              lll1 += '<ol style="display:inline-block">';
              if (pppp1.length > 0) {
                $.each(pppp1, function (ppppp1, ppppp2) {
                  lll1 +=
                    "<li " +
                    (pppp1.length >= 10
                      ? 'style="float:left;display:inline;width:20%"'
                      : "") +
                    ">" +
                    ppppp2["POSICION_COD"] +
                    "</li>";
                });
              } else {
                lll1 += "<li>No hay registros</li>";
              }
              lll1 += "</ol>";
              lll1 += "</div>";
              lll1 += '<div class="modal-footer">';
              lll1 +=
                '<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>';
              lll1 += "</div>";
              $(".modal-content").html(lll1);
            }
          );
        },
      });
    },
    //btn eliminar
    cbtnp: function (pclass, pmethod, pp1) {
      $.getJSON("Cls_Datos/Json.php", {
        page: pclass,
        action: pclass,
        method: pmethod,
        p_id: pp1,
      });
    },
    // btn delete
    btndelete: function () {
      $(document).on(
        {
          click: function () {
            var id = $(this).data("id");
            var view = $(this).data("view");
            $(".confirm-delete").modal("toggle");
            $("input[type=hidden]").val(id);
            $("#confdelete").attr("data-view", view);
            $(".debug-url").html("<b>Id. " + view + ":" + id + "</b>");
          },
        },
        ".jsdelete"
      );
      $(document).on(
        {
          click: function () {
            var id_p = $("#datalistContact").data("idp");
            var id = $("input:hidden[name=id]").val();
            var view = $(this).data("view");
            if (view == "tariff") {
              xD.all.cbtnp("MyTariff", "grud_tariff_delete", id);
              $("#box-tariff" + id).remove();
            }
            $(".confirm-delete").modal("hide");
          },
        },
        "#confdelete"
      );
    },
    run: function () {
      xD.all.fn0();
      xD.all.fn1();
      xD.all.btndelete();
      xD.all.fnmodalview();
    },
  },
};

$(function () {
  xD.all.run();
  $(window).load(function () {});
});
