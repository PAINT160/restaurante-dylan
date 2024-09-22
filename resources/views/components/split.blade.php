<style>
    .line-container {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 30px;
        padding-top: 10px;
        padding-bottom: 10px;

    }

    .line {
        flex-grow: 1;
        height: 1px;

        background-color: light-dark(#000000, #cac7c7);
    }

    .circle {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: light-dark(#000000, #cac7c7);
    }
</style>

<div class="line-container">
    <div class="line"></div>
    <div class="circle"></div>
    <div class="line"></div>
</div>
