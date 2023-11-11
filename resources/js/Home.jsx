import React from "react";
import {createRoot} from 'react-dom/client'
export default function Home(){
   return(
	<>
	<h1>Hola mundo en react</h1>
	</>
)
}

if(document.getElementById('homereact')){
    createRoot(document.getElementById('homereact')).render(<Home/>);
}
