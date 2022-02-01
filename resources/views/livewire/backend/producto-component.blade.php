<div>  
    <div class="modal fade" id="productoModal" tabindex="-1" aria-labelledby="productoModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title col-11 text-center" id="productoModalLabel">
                        @if ($id_producto)
                        Actualización de Producto
                        @else
                        Nuevo Producto
                        @endif


                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="
                    @if ($id_producto)
                    updateData
                    @else
                    createData
                    @endif 
                    
                    
                    " id="formProveedor">
                        <div class="form-group  mb-2">
                            <input type="hidden" wire:model="id_producto">
                            <label for="nombre">Nombre del Producto</label>
                            <input id="nombre" type="text" placeholder="Nombre" class="form-control @error('nombre')
                 is-invalid
                 @enderror" wire:model="nombre">
                            @error('nombre') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>


                        <div class="form-group mb-2">
                            <label for="cod">Codigo del Producto</label>
                            <input id="cod" type="text" placeholder="Codigo" class="form-control @error('cod')
                    is-invalid
                    @enderror" wire:model="cod">
                            @error('cod') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="imagen">Imagenes</label>
                            <input id="imagen" type="file"    accept="image/*" multiple class="form-control-file @error('imagen')
                is-invalid
                @enderror   " wire:model="imagen">
                            @error('imagen') <span class="text-danger">{{ $message }}</span> @enderror
                            @error('imagen.*') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="descripcion">Descripción</label>
                            <textarea id="descripcion" rows="3" placeholder="Descripción" class="form-control @error('descripcion')
                        is-invalid
                        @enderror" wire:model="descripcion">
                    </textarea>
                            @error('descripcion') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="marca">Marca</label>
                            <select id="marca" class="form-control" wire:model="marca" class="form-control @error('marca')
                            is-invalid
                            @enderror">
                                <option selected style="display: none">Selecione la Marca</option>


                                @forelse ($marcas as $mar)
                                <option value="{{ $mar->id }}">{{ $mar->nombre }}</option>
                                @empty
                                <option>no hay opciones disponibles</option>
                                @endforelse
                            </select>
                            @error('marca') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>



                        @if ($id_producto == null)
                        <div class="form-group mb-2">
                            <label for="categoria">Categoria</label>
                            <select id="categoria" class="form-control" wire:model="categoria" class="form-control @error('categoria')
                            is-invalid
                            @enderror">
                                <option selected style="display: none">Selecione la Categoria</option>


                                @forelse ($categorias as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                @empty
                                <option>no hay opciones disponibles</option>
                                @endforelse
                            </select>
                            @error('categoria') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>


                        <div class="form-group mb-2">
                            <label for="subcat">Sub Categoria</label>
                            <select id="subcat" class="form-control" wire:model="subcat" class="form-control @error('subcat')
                                is-invalid
                                @enderror">
                                <option selected style="display: none">Selecione la Sub Categoria</option>


                                @forelse ($sub_categorias as $scat)
                                <option value="{{ $scat->id }}">{{ $scat->nombre }}</option>
                                @empty
                                <option>no hay opciones disponibles</option>
                                @endforelse
                            </select>
                            @error('subcat') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        @else
                            
                        @endif
                        


                        <div class="form-group mb-2">
                            <label for="estilo">Estilo</label>
                            <select id="estilo" class="form-control" wire:model="estilo" class="form-control @error('estilo')
                            is-invalid
                            @enderror">
                                <option selected style="display: none">Selecione el Estilo</option>


                                @forelse ($estilos as $es)
                                <option value="{{ $es->id }}">{{ $es->nombre }}</option>
                                @empty
                                <option>no hay opciones disponibles</option>
                                @endforelse
                            </select>
                            @error('estilo') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="proveedor">Proveedor</label>
                            <select id="proveedor" class="form-control" wire:model="proveedor" class="form-control @error('proveedor')
                                    is-invalid
                                    @enderror">
                                <option selected style="display: none">Selecione el Proveedor</option>


                                @forelse ($proveedores as $pro)
                                <option value="{{ $pro->id }}">{{ $pro->nombre }}</option>
                                @empty
                                <option>no hay opciones disponibles</option>
                                @endforelse
                            </select>
                            @error('proveedor') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        @if ($id_producto == null)
                        <div class="form-group mb-2">
                            <label for="color">Color/es</label>
                            <select multiple id="color" class="form-control" wire:model="color" class="form-control @error('color')
                                    is-invalid
                                    @enderror">
                                <option selected style="display: none">Selecione el/los Colores</option>


                                @forelse ($colores as $col)
                                <option value="{{ $col->id }}">
                                   
                                        {{ $col->nombre }}
                                    
                                    
                                </option>
                                @empty
                                <option>no hay opciones disponibles</option>
                                @endforelse
                            </select>
                            @error('color') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>


                        <div class="form-group mb-2">
                            <label for="talla">Talla/s</label>
                            <select multiple id="talla" class="form-control" wire:model="talla" class="form-control @error('talla')
                                    is-invalid
                                    @enderror">
                                <option selected style="display: none">Selecione la/s Colores</option>


                                @forelse ($tallas as $ta)
                                <option value="{{ $ta->id }}">{{ $ta->nombre }}</option>
                                @empty
                                <option>no hay opciones disponibles</option>
                                @endforelse
                            </select>
                            @error('talla') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        @else
                            
                        @endif

                        @if ($id_producto != null)
                        <div class="form-group mb-2">
                        <label for="estado">Estado</label>
                        <select id="estado" class="form-control" wire:model="estado">
                            @if ($estado == 0)
                            <option selected value="0">Desactivado</option>
                            <option value="1">Activar</option>
                            @else
                            <option selected value="1">Activo</option>
                            <option value="0">Desactivar</option>
                            @endif
                        </select>
                        </div>
                        @else

                        @endif
                      

                       

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" form='formProveedor'>
                        @if ($id_producto)
                        Actualizar
                        @else
                        Guardar
                        @endif

                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center col-11" id="editModalLabel">Actualizacion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <form wire:submit.prevent="updateColor">
            <div class="form-group mb-2">
                <label for="updateColor">Color/es</label>
                <select  id="updateColor" class="form-control" wire:model="updateColor" class="form-control @error('updateColor')
                        is-invalid
                        @enderror">
                    <option selected style="display: none">Selecione el Color</option>


                    @forelse ($colores as $col)
                    <option value="{{ $col->id }}">
                       
                            {{ $col->nombre }}
                        
                        
                    </option>
                    @empty
                    <option>no hay opciones disponibles</option>
                    @endforelse
                </select>
                @error('updateColor') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
         </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
















@push('scripts')
<script>
    $('#productoModal').on('hidden.bs.modal', function (e) {
             Livewire.emit('resetNamesProducto');
         })
 
         window.addEventListener('closeModal', event => {
         $("#productoModal").modal('hide');  
           
           
         });
 
      
 
</script>
@endpush