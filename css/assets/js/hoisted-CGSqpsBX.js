let s=document.querySelector(".link-list"),p=document.querySelectorAll(".link-list li"),y=document.querySelectorAll(".link-list li a"),S=document.querySelector("header"),l=document.querySelector(".icon-nav-base"),d=document.querySelector(".btnFilters  #Now"),o=document.querySelector(".btnFilters  #prev");console.log(o);let n=document.querySelector(".book .now"),a=document.querySelector(".book .prev"),q=()=>{a!==null&&(a.classList.add("active"),a.classList.add("prev")),n.classList.remove("active"),n.classList.remove("now"),d.classList.remove("active"),o.classList.add("active")},g=()=>{n!==null&&(n.classList.add("active"),n.classList.add("now")),a.classList.remove("active"),a.classList.remove("prev"),d.classList.add("active"),o.classList.remove("active")};o!==null&&o.addEventListener("click",q);d!==null&&d.addEventListener("click",g);let h=()=>{window.innerWidth<992?(s.classList.add("Mobile"),s.classList.remove("normalMenu")):(s.classList.remove("Mobile"),s.classList.add("normalMenu"))};h();function L(e){let t=0;return e.forEach(c=>{t+=c.clientHeight}),t}let w=e=>e/(e*.1),f=(e,t,c)=>{let i=e==="down"?0:L(t),r=e==="down"?L(t):0,b=performance.now();function u(){const m=performance.now()-b;let v=w(e==="down"?r:i);if(i<=0&&e==="up"||i>=r&&e==="down"){e==="up"&&(c.style.height="");return}i+=e==="down"?m/v:-(m/v),i>r&&e==="down"&&(i=r),c.style.height=`${i}px`,requestAnimationFrame(u)}requestAnimationFrame(u)},k=()=>{let e=S.clientHeight;s.classList.add("open"),l?.classList.toggle("active");let t=l.classList.contains("active");l.setAttribute("aria-expanded",t.toString()),l.setAttribute("aria-label",t?"open menu":"close menu"),f(t?"down":"up",p,s),s.style.top=`${e}px`,t||setTimeout(()=>{s.classList.remove("open"),s.style.removeProperty("top")},270)},A=()=>{y.forEach(e=>{let t=new URL(e.href).pathname;window.location.pathname===t&&e.classList.add("active")})};A();window.addEventListener("resize",h);l.addEventListener("click",k);
