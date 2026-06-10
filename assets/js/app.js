function notificar(msg, color="#38bdf8"){

    const div = document.createElement("div");

    div.innerText = msg;

    div.style.position = "fixed";
    div.style.bottom = "20px";
    div.style.right = "20px";
    div.style.background = color;
    div.style.color = "#0f172a";
    div.style.padding = "12px 18px";
    div.style.borderRadius = "10px";
    div.style.fontWeight = "bold";
    div.style.zIndex = "9999";
    div.style.boxShadow = "0 0 10px rgba(0,0,0,0.3)";

    document.body.appendChild(div);

    setTimeout(()=> div.remove(), 2500);
}