<div data-component="mi-ul">
    <div class="simple-list-container">
        <ul class="simple-list">
            {{$slot}}
        </ul>
    </div>
</div>

<style>
    [data-component="mi-ul"] {
         .simple-list-container {
            position: relative;
            display: inline-block;
        }

         .simple-list {
            list-style: none;
            padding: 0;
            margin: 0;
            background-color: light-dark(#c8d5e7, #2c2c2c);
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            min-width: 150px;
            z-index: 1000;
        }
    }
</style>