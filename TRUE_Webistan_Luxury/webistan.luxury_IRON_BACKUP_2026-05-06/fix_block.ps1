$file = 'src\components\forms\ProjectCalculator.tsx'
$lines = Get-Content $file

$newBlock = @(
'<div className="group w-screen relative left-1/2 -translate-x-1/2 mt-24 mb-24 text-center py-[60px] overflow-hidden" style={{backgroundColor: `'#0C1618`'}}>',
'  <div className="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-accent/[0.05] to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-[1500ms] ease-in-out" />',
'  <motion.div',
'    initial={{ opacity: 0, scale: 0.98 }}',
'    whileInView={{ opacity: 1, scale: 1 }}',
'    viewport={{ once: true }}',
'    transition={{ duration: 1.5, ease: [0.16, 1, 0.3, 1] }}',
'    className="relative z-10 flex flex-col items-center gap-6 md:gap-8 px-6"',
'  >',
'    <div className="flex items-center gap-6">',
'      <div className="w-16 h-[0.5px] bg-gradient-to-r from-transparent to-accent/50" />',
"      <Sparkles className=""w-8 h-8 md:w-10 md:h-10 text-accent animate-pulse"" strokeWidth={1.5} />",
'      <div className="w-16 h-[0.5px] bg-gradient-to-l from-transparent to-accent/50" />',
'    </div>',
'    <div className="space-y-4 md:space-y-6">',
'      <span className="text-[10px] md:text-[12px] uppercase tracking-[0.3em] md:tracking-[0.5em] text-accent font-display font-medium block">',
"        {t('foundational_partner_protocol')}",
'      </span>',
'      <h3 className="text-[12px] md:text-[16px] uppercase tracking-[0.1em] md:tracking-[0.2em] text-white/80 font-light leading-loose max-w-4xl mx-auto drop-shadow-md text-balance">',
"        {t.rich('discount_text', {",
'          discount: (chunks) => (',
'            <span className="font-bold text-transparent bg-clip-text bg-gradient-to-r from-accent via-[#FFF5E6] to-accent animate-shimmer whitespace-nowrap">',
'              {chunks}',
'            </span>',
'          )',
'        })}',
'      </h3>',
'    </div>',
'  </motion.div>',
'</div>'
)

$result = $lines[0..109] + $newBlock + $lines[150..($lines.Count - 1)]
$result | Set-Content $file -Encoding UTF8
Write-Host "Done. Total lines: $($result.Count)"
