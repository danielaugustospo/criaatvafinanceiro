@include('layouts/include')
@include('layouts/scripts')
@include('layouts/estilo')
<style>

.btn-green:active {
  top: 1px;
  box-shadow: none;
}

.icon {
    position: relative;
}
.btn-green {
    position: relative;
    width: 12%;
    height: 12%;
    margin: 0px auto;
    padding: 0;
    font-size: 22px;
    text-align: center;
    color: white;
    border: none;
    outline: none;
    cursor: pointer;
    overflow: hidden;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
    transition: transform 0.4s ease-in-out;

    background: #1abc9c;
    border-bottom: 2px solid #12ab8d;
    box-shadow: inset 0 -2px #12ab8d;
}
.btn-green .icon {
    width: 24px;
    height: 24px;
    transition: all 0.4s ease-in-out;
}

    .btn-green:hover .icon {
    transform: rotate(360deg) scale(1.2);
}
</style>

<button class="btn btn-green" name="btnatualizar" onclick="location.reload();">
    <img class="icon" src="../public/img/reload-6x-white.png"> 
</button>
