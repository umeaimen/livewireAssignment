@props(['wireIgnoreSelf', 'modelSize', 'modalTitle'])
<div {{ $wireIgnoreSelf }} class="modal  fade" id="main-modal" tabindex="-1" data-bs-backdrop="false" role="dialog">
    <div class="modal-dialog modal-dialog-centered  {{$modelSize}}">
        <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">{{$modalTitle}}</h5>
               <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close" wire:click="closeMainModal">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body ">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
<!-- <div class="modal fade" id="modalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Customer Info</h5>
                <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer bg-light">
                <span class="sub-text">Modal Footer Text</span>
            </div>
        </div>
    </div>
</div> -->