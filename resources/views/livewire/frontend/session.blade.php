<div>
    <!-- Modal -->
    <div class="modal fade" id="accederModal" tabindex="-1" role="dialog" aria-labelledby="accederLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="accederLabel">{{ $showRegister ? 'Registrarse' : 'Iniciar Sesión' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($showRegister)
                        @livewire('frontend.signup', key('register'))
                    @else
                        <div class="card border-0 @if($dirty) slide-out @endif">                          
                          <div class="card-body p-0">
                            @livewire('frontend.login', key('login'))
                          </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn" style="background: #212529; color: #fff;" form="{{ $showRegister ? 'register' : 'login' }}">Iniciar Sesión</button>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            'use strict';

            $('#accederModal').on('hidden.bs.modal', function (e) {
                Livewire.emit('cleanModal');
                /* if (document.getElementById('login')) {
                    document.getElementById('login').querySelector('.form-row').classList.remove('slide-out')
                } */
            })

            /* $('#accederModal').on('show.bs.modal', function (e) {
                if (document.getElementById('login')) {
                    setTimeout(() => {
                        document.getElementById('login').querySelector('.form-row').classList.add('slide-out')
                    }, 1000);
                }
            }) */
        </script>
    @endpush
</div>
