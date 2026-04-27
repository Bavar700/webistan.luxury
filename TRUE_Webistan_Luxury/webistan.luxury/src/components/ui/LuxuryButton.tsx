'use client';
import {
motion 
}
from 'framer-motion';
import {
ReactNode 
}
from 'react';
interface LuxuryButtonProps {
children: ReactNode;
onClick?: () => void
type?: 'button' | 'submit';
className?: string;
width?: string;
height?: string;
style?: React.CSSProperties;
}
export const LuxuryButton = ({
children, onClick,
type = 'button', className = "", width = "w-full", height = "h-[64px]", style }: LuxuryButtonProps) => {
return ( <button
type={type
}
onClick={onClick
}
style={style}
className={`group relative ${width
}
${height
}
transition-all duration-700 hover:scale-[1.02] bg-btn-bg [backdrop-filter:blur(var(--btn-blur))] border-[length:var(--btn-border-width)] border-white/10 [box-shadow:var(--btn-shadow)] text-btn-text hover:bg-btn-hover-bg hover:text-btn-hover-text overflow-hidden ${className}`
}
> {

}
<div className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-accent/[0.07] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out" /> {

}
<div className="absolute top-0 left-0 w-3 h-3 border-t-[0.5px] border-l-[0.5px] border-accent group-hover:w-4 group-hover:h-4 transition-all duration-700" />
<div className="absolute top-0 right-0 w-3 h-3 border-t-[0.5px] border-r-[0.5px] border-accent group-hover:w-4 group-hover:h-4 transition-all duration-700" />
<div className="absolute bottom-0 left-0 w-3 h-3 border-b-[0.5px] border-l-[0.5px] border-accent group-hover:w-4 group-hover:h-4 transition-all duration-700" />
<div className="absolute bottom-0 right-0 w-3 h-3 border-b-[0.5px] border-r-[0.5px] border-accent group-hover:w-4 group-hover:h-4 transition-all duration-700" />
<div className="relative z-10 flex items-center justify-center text-[10px] md:text-[11px] font-display uppercase tracking-[0.6em] text-btn-text/90 group-hover:text-btn-hover-text transition-all duration-700 -mr-[0.6em]"> {children
}
</div>
</button> );
};
