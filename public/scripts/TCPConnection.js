export const TCPConnection = (send, recive) => {
    let connection = new WebSocket('wss://healthandtourismturkey.com/ws');
    connection.send(send);
    connection.onopen = function (e) {
        console.log("Connection stablished");
    }
    connection.onmessage = function (e) {
        console.log(e.data);
    }
}
