'use client';
import {
motion 
}
from 'framer-motion';
export const WebistanSymbol = ({
className = "w-9 h-10" }: {
className?: string }) => {

 
 
const pathD = "M9 1C13.4183 1 17 4.58172 17 9C17 13.4183 20.5817 17 25 17C29.4183 17 33 13.4183 33 9C33 4.58172 29.4183 1 25 1C20.5817 1 17 4.58172 17 9C17 13.4183 13.4183 17 9 17C4.58172 17 1 13.4183 1 9C1 4.58172 4.58172 1 9 1Z";
const pathLength = 104;
const duration = 6;
return ( <div className={`flex-shrink-0 flex items-center justify-center ${className}`}>
<svg viewBox="0 0 36 18" fill="none" xmlns="http://www.w3.org/2000/svg" className="overflow-visible w-full h-full" > {

}
<motion.path d={pathD
}
stroke="#C0A080" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" strokeDasharray={`${pathLength * 0.85
}
${pathLength * 0.15}`
}
animate={{
strokeDashoffset: [0, -pathLength] }
}
transition={{
duration: duration, repeat: Infinity, ease: "linear" }
}
style={{
filter: "drop-shadow(0 0 5px rgba(192, 160, 128, 0.4))" }
}
/> {

}
<motion.path d={pathD
}
stroke="#FFF" strokeWidth="2.5" strokeLinecap="round" strokeDasharray="1 103" initial={{
strokeDashoffset: pathLength }
}
animate={{
strokeDashoffset: [pathLength, 0], }
}
transition={{
strokeDashoffset: {
duration: duration, repeat: Infinity, ease: "linear" 
}
}
}
style={{
filter: "drop-shadow(0 0 8px #FFF)" }
}
/> {

}
<motion.path d={pathD
}
stroke="#FFF" strokeWidth="2.5" strokeLinecap="round" strokeDasharray="1 103" initial={{
strokeDashoffset: pathLength }
}
animate={{
strokeDashoffset: [pathLength, 0], opacity: [1, 0, 1, 0.2, 1, 0.1, 1] }
}
transition={{
strokeDashoffset: {
duration: duration, repeat: Infinity, ease: "linear" }, opacity: {
duration: 0.15, repeat: Infinity, ease: "linear" 
}
}
}
/>
</svg>
</div> );
};
