'use client';
import React from 'react';
import { WebistanSymbol } from '@/components/ui/WebistanSymbol';

export const BrandLogo = ({ className = "" }: { className?: string }) => {
  return (
    <div className={`flex items-center gap-[4px] group brand-logo text-foreground ${className}`}>
      <WebistanSymbol className="w-[30px] h-[15px] opacity-90 group-hover:opacity-100 transition-opacity duration-700" />

      <div className="flex items-center tracking-[0.05em] uppercase font-display font-bold text-[12px] md:text-[14px] leading-none">
        <span>&nbsp;</span>
        <span className="text-foreground transition-all duration-700">WEBISTAN</span>
        <span className="text-accent">.LUXURY</span>
      </div>
    </div>
  );
};

export default BrandLogo;
