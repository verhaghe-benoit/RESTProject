<style>
body {
    background: #19293a;
    color: #d3d7de;
    font-family: "Courier new";
    font-size: 18px;
    line-height: 1.5em;
	cursor: default;
}

.code-area {
    position: absolute;
    width: 320px; /*275*/
	min-width: 320px;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}

.code-area > span {
    display: block;
}

@media  screen and (max-width: 320px) {
    .code-area {
		font-size: 5vw;
		min-width: auto;
        width: 95%;
		margin: auto;
		padding: 5px;
		padding-left: 10px;
		line-height: 6.5vw;
    }
}
</style>

<div class="code-area">
  <span style="color: #777;font-style:italic;">
    // Nano Framework Jenaye
  </span>
  <span>
    <span style="color:#d65562;">
      if
    </span>
	  (<span style="color:#4ca8ef;">install = </span><span style="font-style: italic;">ok</span>)
    {
  </span>
  <span>
    <span style="padding-left: 15px;color:#2796ec">
       <i style="width: 10px;display:inline-block"></i>throw
    </span>
    <span>
      (<span style="color: #a6a61f">'Homepage framework version 1.2'</span>);
    </span>
	  <span style="display:block">}</span>
  </span>
</div>