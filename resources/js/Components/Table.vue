

<template>
    <div class="table-responsive">

        <table class="table table-striped table-bordered m-0">
            <thead class="text-center">
                <tr>
                    <slot name="head"></slot>
                </tr>
            </thead>
            <tbody>
                
                    <slot name="body"></slot>
                
            </tbody>
       
        </table>
    </div>
</template>