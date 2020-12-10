<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Voice Controlled Notes App</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/shoelace-css/1.0.0-beta16/shoelace.css">
        <link rel="stylesheet" href="styles.css">

    </head>
    <body>
        <div class="container">

            <h1>speech to text app</h1>
            

            <h3 class="no-browser-support">Sorry, Your Browser Doesn't Support the Web Speech API. Try Opening This Demo In Google Chrome.</h3>

            <div class="app"> 
                <h3>Add New Note by your voice</h3>
                <div class="input-single">
                    <textarea id="note-textarea" placeholder="Create a new note by typing or using voice recognition." rows="6"></textarea>
                </div>         
                <button id="start-record-btn" title="Start Recording">Start Recognition</button>
                <button id="pause-record-btn" title="Pause Recording">Pause Recognition</button>
                <button id="save-note-btn" title="Save Note">Save Note</button>   
                <p id="recording-instructions">Press the <strong>Start Recognition</strong> button and allow access.</p>
                
                <h3>My Notes</h3>
                <ul id="notes">
                    <li>
                        <p class="no-notes">You don't have any notes.</p>
                    </li>
                </ul>

            </div>

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="script.js"></script>


    </body>
</html>


