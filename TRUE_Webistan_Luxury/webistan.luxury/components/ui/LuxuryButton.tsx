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
  onClick?: () => void;
  type?: 'button' | 'submit';
  className?: string;
  width?: string;
  height?: string;
  style?: React.CSSProperties;
  showCorners?: boolean;
  disabled?: boolean;
}

export const LuxuryButton = ({
  children,
  onClick,
  type = 'button',
  className = "",
  width = "w-full",
  height = "h-[64px]",
  style,
  showCorners = true,
  disabled = false
}: LuxuryButtonProps) => {
  return (
    <button
      type={type}
      onClick={onClick}
      disabled={disabled}
      style={style}
      className={`group relative ${width} ${height} transition-all duration-700 ${disabled ? 'opacity-50 cursor-not-allowed' : 'hover:scale-[1.02]'} bg-btn-bg [backdrop-filter:blur(var(--btn-blur))] border-[length:var(--btn-border-width)] border-[var(--border-color)] [box-shadow:var(--btn-shadow)] text-btn-text hover:bg-btn-hover-bg hover:text-btn-hover-text ${className}`}
    >
      {/* Shimmer Layer - Isolated Overflow */}
      <div className="absolute inset-0 w-full h-full overflow-hidden pointer-events-none">
        <div className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-accent/[0.07] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-in-out" />
      </div>
      
      {/* Corner Accents - Outside Overflow */}
      {showCorners && (
        <>
          <div className="absolute top-0 left-0 w-3 h-3 border-t-[0.5px] border-l-[0.5px] border-accent/20 group-hover:border-accent/80 group-hover:w-4 group-hover:h-4 transition-all duration-700" />
          <div className="absolute top-0 right-0 w-3 h-3 border-t-[0.5px] border-r-[0.5px] border-accent/20 group-hover:border-accent/80 group-hover:w-4 group-hover:h-4 transition-all duration-700" />
          <div className="absolute bottom-0 left-0 w-3 h-3 border-b-[0.5px] border-l-[0.5px] border-accent/20 group-hover:border-accent/80 group-hover:w-4 group-hover:h-4 transition-all duration-700" />
          <div className="absolute bottom-0 right-0 w-3 h-3 border-b-[0.5px] border-r-[0.5px] border-accent/20 group-hover:border-accent/80 group-hover:w-4 group-hover:h-4 transition-all duration-700" />
        </>
      )}
      
      <div className="relative z-10 flex items-center justify-center text-[10px] md:text-[11px] font-display uppercase tracking-[0.6em] text-btn-text/90 group-hover:text-btn-hover-text transition-all duration-700 -mr-[0.6em]">
        {children}
      </div>
    </button>
  );
};
