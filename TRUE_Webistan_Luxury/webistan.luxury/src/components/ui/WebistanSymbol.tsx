'use client';
import { motion } from 'framer-motion';

export const WebistanSymbol = ({ className = "w-9 h-10" }: { className?: string }) => {
  const pathLength = 100.55;
  const pathD = "M9 1C13.4183 1 17 4.58172 17 9C17 13.4183 20.5817 17 25 17C29.4183 17 33 13.4183 33 9C33 4.58172 29.4183 1 25 1C20.5817 1 17 4.58172 17 9C17 13.4183 13.4183 17 9 17C4.58172 17 1 13.4183 1 9C1 4.58172 4.58172 1 9 1Z";
  const duration = 6;

  return (
    <div className={`flex-shrink-0 flex items-center justify-center ${className}`}>
      <svg 
        viewBox="0 0 36 18" 
        fill="none" 
        xmlns="http://www.w3.org/2000/svg" 
        className="overflow-visible w-full h-full"
        shapeRendering="geometricPrecision"
      >
        <defs>
          <linearGradient id="symbolShimmer" x1="0%" y1="0%" x2="200%" y2="0%" gradientUnits="userSpaceOnUse">
            <stop offset="0%" stopColor="var(--accent)" />
            <stop offset="25%" stopColor="#FFFFFF" />
            <stop offset="50%" stopColor="var(--accent)" />
            <stop offset="75%" stopColor="#FFFFFF" />
            <stop offset="100%" stopColor="var(--accent)" />
            
            <animateTransform 
              attributeName="gradientTransform"
              type="translate"
              from="0 0"
              to="-36 0"
              dur="5s"
              repeatCount="indefinite"
            />
          </linearGradient>
        </defs>

        {/* Layer 1: Base Path (Original Crawling Dash) */}
        <motion.path
          d={pathD}
          stroke="#B8860B"
          strokeWidth="3.6"
          strokeLinecap="round"
          strokeLinejoin="round"
          strokeDasharray={`${pathLength * 0.85} ${pathLength * 0.15}`}
          animate={{
            strokeDashoffset: [0, -pathLength],
          }}
          transition={{
            duration: duration,
            repeat: Infinity,
            ease: "linear",
          }}
        />

        {/* Layer 2: Shimmering Highlights Overlay */}
        <motion.path
          d={pathD}
          stroke="url(#symbolShimmer)"
          strokeWidth="3.8"
          strokeLinecap="round"
          strokeLinejoin="round"
          strokeDasharray={`${pathLength * 0.85} ${pathLength * 0.15}`}
          style={{ opacity: 0.9 }}
          animate={{
            strokeDashoffset: [0, -pathLength],
          }}
          transition={{
            duration: duration,
            repeat: Infinity,
            ease: "linear",
          }}
        />
      </svg>
    </div>
  );
};
