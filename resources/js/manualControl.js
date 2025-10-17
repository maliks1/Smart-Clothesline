// Hubungkan ke HiveMQ Public Broker via WebSocket Secure (wss)
const client = mqtt.connect("wss://broker.hivemq.com:8884/mqtt", {
    clientId: "webclient_" + Math.random().toString(16).substr(2, 8),
});

const statusEl = document.getElementById("status");
const logEl = document.getElementById("log");

client.on("connect", () => {
    statusEl.textContent = "✅ Terhubung ke HiveMQ";
    statusEl.style.color = "green";
    console.log("Connected!");
    // Subscribe ke topik default (biar bisa lihat pesan yang dikirim juga)
    client.subscribe("jemuran/status");
});

client.on("message", (topic, message) => {
    const text = `[${topic}] ${message.toString()}\n`;
    logEl.textContent += text;
    logEl.scrollTop = logEl.scrollHeight;
});

document.getElementById("btnKirim").addEventListener("click", () => {
    const topic = document.getElementById("topic").value;
    const msg = document.getElementById("message").value;

    if (!msg) return alert("Masukkan pesan terlebih dahulu!");
    client.publish(topic, msg);
    logEl.textContent += `(You) [${topic}] ${msg}\n`;
    logEl.scrollTop = logEl.scrollHeight;
    document.getElementById("message").value = "";
});
