import pyttsx3 #pip install pyttsx3
import speech_recognition as sr #pip install speechRecognition
import datetime
import wikipedia #pip install wikipedia
import webbrowser
import os
import smtplib

engine = pyttsx3.init('sapi5')
voices = engine.getProperty('voices')
engine.setProperty('voice', voices[0].id)


def speak(audio):
    engine.say(audio)
    engine.runAndWait()


def wishMe():
    hour = int(datetime.datetime.now().hour)
    if hour>=0 and hour<12:
        speak("Good Morning!")

    elif hour>=12 and hour<18:
        speak("Good Afternoon!")   

    else:
        speak("Good Evening!")  

    speak("hi sanskar! i am jarvis speed one terahertz, memory one zettabyte. how may i help you? ")       

def takeCommand():
    #It takes microphone input from the user and returns string output

    r = sr.Recognizer()
    with sr.Microphone() as source:
        print("Listening...")
        r.pause_threshold = 1
        audio = r.listen(source)

    try:
        print("Recognizing...")    
        query = r.recognize_google(audio, language='en-in')
        print(f"User said: {query}\n")

    except Exception as e:
        # print(e)    
        print("Say that again please...")  
        return "None"
    return query

def sendEmail(to, content):
    server = smtplib.SMTP('smtp.gmail.com', 587)
    server.ehlo()
    server.starttls()
    server.login('youremail@gmail.com', 'your-password')
    server.sendmail('youremail@gmail.com', to, content)
    server.close()

if __name__ == "__main__":
    wishMe()
    while True:
        query = takeCommand().lower()
  # Logic for executing tasks based on query
        if 'wikipedia' in query:
            speak('Searching Wikipedia...')
            query = query.replace("wikipedia", "")
            results = wikipedia.summary(query, sentences=2)
            speak("According to Wikipedia")
            print(results)
            speak(results)

        elif 'open youtube' in query:
            webbrowser.open("youtube.com")

        elif 'open google' in query:
            webbrowser.open("google.com")

        elif 'open stackoverflow' in query:
            webbrowser.open("stackoverflow.com") 
     
        elif 'open spotify' in query :
            webbrowser.open("spotify.com")  


        elif 'play music' in query:
            music_dir = 'D:\\songs'
            songs = os.listdir(music_dir)
            print(songs)    
            os.startfile(os.path.join(music_dir, songs[0]))

        elif 'the time' in query:
            strTime = datetime.datetime.now().strftime("%H:%M:%S")    
            speak(f"Sir, the time is {strTime}")

        elif 'meaning of life' in query :
            speak("Dilon mein tum apni Betaabiyan leke chal rahe ho , Toh zinda ho tum. Nazar mein khwabon ki Bijliyan leke chal rahe ho,Toh zinda ho tum. Hawa ke jhokon ke jaise Aazad rehno sikho. Tum ek dariya ke jaise Lehron mein behna sikho. Har ek lamhe se tum milo Khole apni bhaahein. Har ek pal ek naya samha Dekhen yeh nigahaein.Jo apni aankhon mein Hairaniyan leke chal rahe ho ,Toh zinda ho tum. Dilon mein tum apni Betaabiyan leke chal rahe ho ,Toh zinda ho tum")
        

        elif 'open code' in query:
            codePath = "C:\\Users\\DELL\\AppData\\Roaming\\Microsoft\\Windows\\Start Menu\\Programs\\Visual Studio Code\\code.exe"
            os.startfile(codePath)
       
        
        elif 'audacity' in query :
            codePath = "C:\\ProgramData\\Microsoft\\Windows\\Start Menu\\Programs\\Audacity"
            os.startfile(codePath)

        elif 'email to sanskar' in query:
            try:
                speak("What should I say?")
                content = takeCommand()
                to = "sanskarmundaniya@gmail.com"    
                sendEmail(to, content)
                speak("Email has been sent!")
            except Exception as e:
                speak("Sorry my friend. I am not able to send this email")    