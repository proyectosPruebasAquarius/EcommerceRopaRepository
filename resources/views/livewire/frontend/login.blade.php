<div>
    <form id="login" wire:submit.prevent="login()">
        <div class="form-row">
            <div class="form-group col-12">
                <label for="exampleFormControlInput1">Correo Eléctronico</label>
                <input type="email" class="form-control  @error('email') is-invalid @enderror" id="exampleFormControlInput1" placeholder="nombre@example.com" wire:model="email">
                @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
           
            <div class="form-group col-12">
                <label for="inputPassword4">Contraseña</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword4" wire:model="password">
                @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
            </div>
            
            <div class="form-group col-md-12">                                
                <span class="d-inline">¿No tienes una cuenta?<a type="button" class="btn btn-default d-inline mb-1 text-primary" wire:click="$emit('showRegister', true)">Registrate</a></span>                                
            </div>
        </div>
    </form>
</div>
