<div>
    <div class="modal fade" id="pedidosModal" tabindex="-1" aria-labelledby="pedidosModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title col-11 text-center" id="pedidosModalLabel">Descarga de PDF de
                Pedidos de Proveedores</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('admin/pedidos/pdf') }}" method="post" id="FormPDFS">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="FechaIncio" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="FechaIncio"
                            aria-describedby="emailHelp" name="fecha_inicio">

                    </div>
                    <div class="mb-3">
                        <label for="FechaFin" class="form-label">Fecha de Fin</label>
                        <input type="date" class="form-control" id="FechaFin"
                            aria-describedby="emailHelp" name="fecha_fin">

                    </div>
                    <div id="emailHelp" class="form-text"><strong>Selecciona la Fecha ó Fechas de las cuales deseas optener los datos</strong>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary">Descargar PDF</button>
            </div>
          </div>
        </div>
      </div>
</div>
