<div>
    <form wire:submit.prevent="register()" id="register">
        <div class="form-row slide-in">
            <div class="form-group col-12">
                <label for="exampleFormControlInput1">Correo Eléctronico</label>
                <input type="email" class="form-control  @error('email') is-invalid @enderror" id="exampleFormControlInput1" placeholder="nombre@example.com" wire:model.lazy="email">
                @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
                <div class="form-group col-12">
                    <label for="usuario">Nombres y Apellidos</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="usuario" wire:model.lazy="name">
                    @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
            <div class="form-group col-12">
                <label for="inputPassword4">Contraseña</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword4" wire:model.lazy="password">
                @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
                <div class="form-group col-12">
                    <label for="password-confirm">{{ __('Confirmar Contraseña') }}</label>
                    <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="new-password" wire:model.lazy="password_confirmation">     
                    @error('password_confirmation') <span class="error text-danger">{{ $message }}</span> @enderror                           
                </div>
            <div class="form-group col-md-12">        
                <span class="d-inline">¿Ya tienes una cuenta?<a type="button" class="btn btn-default d-inline mb-1 text-primary" wire:click="$emit('showRegister', false)">Inicia Sesión</a></span>                                                
            </div>
        </div>
    </form>
    @push('scripts')
        <script>
            'use strict';

            Livewire.on('cleanModal', () => {
                @this.clean();
            })
        </script>
    @endpush
</div>
