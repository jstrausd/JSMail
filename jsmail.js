const HttpClient = function() {
    this.get = function(aUrl, aCallback) {
        const anHttpRequest = new XMLHttpRequest();
        anHttpRequest.onreadystatechange = function() { 
            if (anHttpRequest.readyState == 4 && anHttpRequest.status == 200)
                aCallback(anHttpRequest.responseText);
        }

        anHttpRequest.open( 'GET', aUrl, true );            
        anHttpRequest.send( null );
    }
    this.post = function(url, data, aCallback) {
        const anHttpRequest = new XMLHttpRequest();
        anHttpRequest.onreadystatechange = function() { 
            if (anHttpRequest.readyState == 4 && anHttpRequest.status == 200)
                aCallback(anHttpRequest.responseText);
        }

        anHttpRequest.open( 'POST', url, true );   
        anHttpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");         
        anHttpRequest.send( data );
    }
}

const jsmail = {
    sendMail(recipient,recipient_name,sender_mail,sender_name,sender_password,sender_smtp,sender_smtp_port,message,subject){
        const client = new HttpClient();
        console.log('mail.php?recipient=' + recipient + '&recipient_name=' + recipient_name + '&sender_mail=' + sender_mail + '&sender_name=' + sender_name + '&sender_password=' + sender_password + '&sender_smtp=' + sender_smtp + '&sender_smtp_port=' + sender_smtp_port + '&message=' + message + '&subject=' + subject);
        client.post('mail.php', 'recipient=' + recipient + '&recipient_name=' + recipient_name + '&sender_mail=' + sender_mail + '&sender_name=' + sender_name + '&sender_password=' + sender_password + '&sender_smtp=' + sender_smtp + '&sender_smtp_port=' + sender_smtp_port + '&message=' + message + '&subject=' + subject, function(response) {
            console.log(response);
            return response;
        });
    }
}