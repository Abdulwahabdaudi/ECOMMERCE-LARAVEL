<script setup>

import { defineProps } from 'vue';

defineProps({
    closeIt: Boolean,
})

</script>



<template>
    <div>
        <div class="modal fade" tabindex="-1" id="modal" arial-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- <div class="modal-header">
                    <h5 class="modal-title text-center">UPDATE</h5> 
                </div> -->
                    <div class="modal-body">
                        <slot></slot>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary w-100" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</template>