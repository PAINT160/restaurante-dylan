    <style>
        .plate {
            width: 36px;
            height: 36px;
            background: linear-gradient(145deg, #ffffff, #e6e6e6);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            box-shadow:
                1px 1px 24px #d1d1d1,
                -1px -1px 24px #ffffff;
        }

        .plate::before {
            content: '';
            position: absolute;
            top: 8%;
            left: 8%;
            right: 8%;
            bottom: 8%;
            background-color: white;
            border-radius: 50%;
            box-shadow:
                inset 4px 4px 8px rgba(0, 0, 0, 0.1),
                inset -4px -4px 8px rgba(255, 255, 255, 0.9);
        }

        .plate a {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 70%;
            height: 70%;
            border-radius: 50%;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }

        .plate img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .plate a:hover img {
            transform: scale(1.1);
        }
    </style>
    <div class="plate">
        <a href="#">
            <img src="https://github.com/favicon.ico" alt="Imagen de ejemplo">
        </a>
    </div>
