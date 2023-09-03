<script>
export default {
    name:"LoginLayout",

}
</script>

<template>
    <div class="hold-transition login-page">
        <div class="login-box">
            <div class="card">
                <slot name="content"></slot>
            </div>
        </div>
    </div>
</template>

