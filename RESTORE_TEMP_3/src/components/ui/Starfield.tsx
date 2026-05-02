'use client';

import { useEffect, useRef } from 'react';

export const Starfield = () => {
    const canvasRef = useRef<HTMLCanvasElement>(null);

    useEffect(() => {
        const canvas = canvasRef.current;
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        if (!ctx) return;

        let animationFrameId: number;
        let stars: { x: number; y: number; radius: number; speed: number; opacity: number; opacityDir: number; color: string; twinkleSpeed: number }[] = [];

        // Colors: pure whites, light blues, deep blues, gold, champagne, and pale cyan
        const colors = [
            '#ffffff', '#ffffff', '#ffffff', // High chance of white
            '#C0A080', '#FFD700', // Gold / Champagne
            '#e0e0e0', '#f5ebd9',
            '#7FB5FF', '#A3C8FF', '#4A90E2', // Various blues
            '#9A8AFA', // Faint purple/magenta
        ];

        const resize = () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            initStars();
        };

        const initStars = () => {
            stars = [];
            // High density for Milky Way effect
            const numStars = Math.floor((canvas.width * canvas.height) / 1800);

            for (let i = 0; i < numStars; i++) {
                // Determine size: most stars are tiny (exponential distribution)
                // Math.pow gives a curve where smaller values are far more common
                const baseSize = Math.pow(Math.random(), 3);
                const radius = baseSize * 2.5 + 0.1; // Range: ~0.1 to 2.6

                // Milky way band generation (diagonal from top-left to bottom-right)
                let x = Math.random() * canvas.width;
                let y = Math.random() * canvas.height;

                // 35% chance to be inside the "Milky Way" diagonal cluster
                if (Math.random() < 0.35) {
                    const bandCenterY = (x / canvas.width) * canvas.height;
                    const offset = (Math.random() - 0.5) * (canvas.height * 0.4); // Spread
                    y = bandCenterY + offset;
                    // Keep within canvas bounds
                    if (y < 0) y = Math.random() * canvas.height;
                    if (y > canvas.height) y = Math.random() * canvas.height;
                }

                stars.push({
                    x,
                    y,
                    radius,
                    // Parallax: bigger stars move slightly faster
                    speed: (radius * 0.15) + (Math.random() * 0.1),
                    opacity: Math.random(),
                    opacityDir: Math.random() > 0.5 ? 1 : -1,
                    color: colors[Math.floor(Math.random() * colors.length)],
                    // Twinkle speed varies per star
                    twinkleSpeed: (Math.random() * 0.008) + 0.002
                });
            }
        };

        const render = () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            stars.forEach(star => {
                // Twinkle effect
                star.opacity += star.twinkleSpeed * star.opacityDir;
                if (star.opacity <= 0.1) {
                    star.opacity = 0.1;
                    star.opacityDir = 1;
                } else if (star.opacity >= 1) {
                    star.opacity = 1;
                    star.opacityDir = -1;
                }

                // Drift slowly upwards and slightly right (cosmic drift)
                star.y -= star.speed;
                star.x += star.speed * 0.2;

                // Wrap around edges
                if (star.y < 0) {
                    star.y = canvas.height;
                    star.x = Math.random() * canvas.width;
                }
                if (star.x > canvas.width) {
                    star.x = 0;
                }

                // Render star
                ctx.beginPath();
                ctx.arc(star.x, star.y, star.radius, 0, Math.PI * 2);
                ctx.fillStyle = star.color;

                // Add soft glowing effect for larger stars
                if (star.radius > 1.2) {
                    ctx.shadowBlur = star.radius * 3;
                    ctx.shadowColor = star.color;
                } else {
                    ctx.shadowBlur = 0;
                }

                ctx.globalAlpha = star.opacity;
                ctx.fill();
            });

            ctx.globalAlpha = 1;
            ctx.shadowBlur = 0; // Reset shadow for next frame
            animationFrameId = requestAnimationFrame(render);
        };

        window.addEventListener('resize', resize);
        resize();
        render();

        return () => {
            window.removeEventListener('resize', resize);
            cancelAnimationFrame(animationFrameId);
        };
    }, []);

    return (
        <div className="fixed inset-0 w-screen h-screen pointer-events-none z-0 overflow-hidden">
            {/* Deep space base layer with subtle blue nebula gradients */}
            <div className="absolute inset-0 bg-[#02040A]" />
            <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_30%_20%,_rgba(10,25,60,0.4)_0%,_transparent_60%)]" />
            <div className="absolute inset-0 bg-[radial-gradient(ellipse_at_80%_80%,_rgba(20,15,40,0.3)_0%,_transparent_50%)]" />

            <canvas
                ref={canvasRef}
                className="absolute inset-0 w-full h-full opacity-90"
            />
        </div>
    );
};
