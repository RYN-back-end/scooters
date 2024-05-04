import '@astrojs/internal-helpers/path';
import { l as lookup, r as resolveSrc, i as isRemoteImage, a as isESMImportedImage, b as isLocalService, D as DEFAULT_HASH_PROPS } from './astro/assets-service-DqWad7a2.js';
import { c as createAstro, b as createComponent, r as renderTemplate, d as addAttribute, A as AstroError, e as ExpectedImageOptions, E as ExpectedImage, F as FailedToFetchRemoteImageDimensions, f as InvalidImageService, g as ImageMissingAlt, m as maybeRenderHead, s as spreadAttributes, h as renderSlot, i as renderComponent, j as renderHead, u as unescapeHTML, k as Fragment } from './astro-QIgS8Bvn.js';
import 'kleur/colors';
/* empty css                            */
/* empty css                          */
/* empty css                         */
/* empty css                          */
import 'clsx';
/* empty css                                 */
/* empty css                          */
/* empty css                        */
import { getIconData, iconToSVG } from '@iconify/utils';

const $$Astro$z = createAstro();
const $$BaseHead = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$z, $$props, $$slots);
  Astro2.self = $$BaseHead;
  const { title, description } = Astro2.props;
  return renderTemplate`<meta charset="UTF-8"><meta name="description" content="Astro description"><meta name="viewport" content="width=device-width"><link rel="icon" type="image/svg+xml" href="favicon.svg"><meta name="generator"${addAttribute(Astro2.generator, "content")}><!-- Font preloads --><link rel="preload" href="/fonts/Sukar-black.woff2" as="font" type="font/woff2" crossorigin><link rel="preload" href="/fonts/Sukar-Bold.woff2" as="font" type="font/woff2" crossorigin><link rel="preload" href="/fonts/SukarRegular.woff2" as="font" type="font/woff2" crossorigin><!-- Primary Meta Tags --><title>${title}</title><meta name="title"${addAttribute(title, "content")}><meta name="description"${addAttribute(description, "content")}>`;
}, "D:/project/version/2/Astro/scooter/src/components/BaseHead.astro", void 0);

async function probe(url) {
  const response = await fetch(url);
  if (!response.body || !response.ok) {
    throw new Error("Failed to fetch image");
  }
  const reader = response.body.getReader();
  let done, value;
  let accumulatedChunks = new Uint8Array();
  while (!done) {
    const readResult = await reader.read();
    done = readResult.done;
    if (done)
      break;
    if (readResult.value) {
      value = readResult.value;
      let tmp = new Uint8Array(accumulatedChunks.length + value.length);
      tmp.set(accumulatedChunks, 0);
      tmp.set(value, accumulatedChunks.length);
      accumulatedChunks = tmp;
      try {
        const dimensions = lookup(accumulatedChunks);
        if (dimensions) {
          await reader.cancel();
          return dimensions;
        }
      } catch (error) {
      }
    }
  }
  throw new Error("Failed to parse the size");
}

async function getConfiguredImageService() {
  if (!globalThis?.astroAsset?.imageService) {
    const { default: service } = await import(
      // @ts-expect-error
      './astro/assets-service-DqWad7a2.js'
    ).then(n => n.s).catch((e) => {
      const error = new AstroError(InvalidImageService);
      error.cause = e;
      throw error;
    });
    if (!globalThis.astroAsset)
      globalThis.astroAsset = {};
    globalThis.astroAsset.imageService = service;
    return service;
  }
  return globalThis.astroAsset.imageService;
}
async function getImage$1(options, imageConfig) {
  if (!options || typeof options !== "object") {
    throw new AstroError({
      ...ExpectedImageOptions,
      message: ExpectedImageOptions.message(JSON.stringify(options))
    });
  }
  if (typeof options.src === "undefined") {
    throw new AstroError({
      ...ExpectedImage,
      message: ExpectedImage.message(
        options.src,
        "undefined",
        JSON.stringify(options)
      )
    });
  }
  const service = await getConfiguredImageService();
  const resolvedOptions = {
    ...options,
    src: await resolveSrc(options.src)
  };
  if (options.inferSize && isRemoteImage(resolvedOptions.src)) {
    try {
      const result = await probe(resolvedOptions.src);
      resolvedOptions.width ??= result.width;
      resolvedOptions.height ??= result.height;
      delete resolvedOptions.inferSize;
    } catch {
      throw new AstroError({
        ...FailedToFetchRemoteImageDimensions,
        message: FailedToFetchRemoteImageDimensions.message(resolvedOptions.src)
      });
    }
  }
  const originalFilePath = isESMImportedImage(resolvedOptions.src) ? resolvedOptions.src.fsPath : void 0;
  const clonedSrc = isESMImportedImage(resolvedOptions.src) ? (
    // @ts-expect-error - clone is a private, hidden prop
    resolvedOptions.src.clone ?? resolvedOptions.src
  ) : resolvedOptions.src;
  resolvedOptions.src = clonedSrc;
  const validatedOptions = service.validateOptions ? await service.validateOptions(resolvedOptions, imageConfig) : resolvedOptions;
  const srcSetTransforms = service.getSrcSet ? await service.getSrcSet(validatedOptions, imageConfig) : [];
  let imageURL = await service.getURL(validatedOptions, imageConfig);
  let srcSets = await Promise.all(
    srcSetTransforms.map(async (srcSet) => ({
      transform: srcSet.transform,
      url: await service.getURL(srcSet.transform, imageConfig),
      descriptor: srcSet.descriptor,
      attributes: srcSet.attributes
    }))
  );
  if (isLocalService(service) && globalThis.astroAsset.addStaticImage && !(isRemoteImage(validatedOptions.src) && imageURL === validatedOptions.src)) {
    const propsToHash = service.propertiesToHash ?? DEFAULT_HASH_PROPS;
    imageURL = globalThis.astroAsset.addStaticImage(
      validatedOptions,
      propsToHash,
      originalFilePath
    );
    srcSets = srcSetTransforms.map((srcSet) => ({
      transform: srcSet.transform,
      url: globalThis.astroAsset.addStaticImage(srcSet.transform, propsToHash, originalFilePath),
      descriptor: srcSet.descriptor,
      attributes: srcSet.attributes
    }));
  }
  return {
    rawOptions: resolvedOptions,
    options: validatedOptions,
    src: imageURL,
    srcSet: {
      values: srcSets,
      attribute: srcSets.map((srcSet) => `${srcSet.url} ${srcSet.descriptor}`).join(", ")
    },
    attributes: service.getHTMLAttributes !== void 0 ? await service.getHTMLAttributes(validatedOptions, imageConfig) : {}
  };
}

const $$Astro$y = createAstro();
const $$Image = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$y, $$props, $$slots);
  Astro2.self = $$Image;
  const props = Astro2.props;
  if (props.alt === void 0 || props.alt === null) {
    throw new AstroError(ImageMissingAlt);
  }
  if (typeof props.width === "string") {
    props.width = parseInt(props.width);
  }
  if (typeof props.height === "string") {
    props.height = parseInt(props.height);
  }
  const image = await getImage(props);
  const additionalAttributes = {};
  if (image.srcSet.values.length > 0) {
    additionalAttributes.srcset = image.srcSet.attribute;
  }
  return renderTemplate`${maybeRenderHead()}<img${addAttribute(image.src, "src")}${spreadAttributes(additionalAttributes)}${spreadAttributes(image.attributes)}>`;
}, "D:/project/version/2/Astro/scooter/node_modules/astro/components/Image.astro", void 0);

const $$Astro$x = createAstro();
const $$Picture = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$x, $$props, $$slots);
  Astro2.self = $$Picture;
  const defaultFormats = ["webp"];
  const defaultFallbackFormat = "png";
  const specialFormatsFallback = ["gif", "svg", "jpg", "jpeg"];
  const { formats = defaultFormats, pictureAttributes = {}, fallbackFormat, ...props } = Astro2.props;
  if (props.alt === void 0 || props.alt === null) {
    throw new AstroError(ImageMissingAlt);
  }
  const originalSrc = await resolveSrc(props.src);
  const optimizedImages = await Promise.all(
    formats.map(
      async (format) => await getImage({
        ...props,
        src: originalSrc,
        format,
        widths: props.widths,
        densities: props.densities
      })
    )
  );
  let resultFallbackFormat = fallbackFormat ?? defaultFallbackFormat;
  if (!fallbackFormat && isESMImportedImage(originalSrc) && originalSrc.format in specialFormatsFallback) {
    resultFallbackFormat = originalSrc.format;
  }
  const fallbackImage = await getImage({
    ...props,
    format: resultFallbackFormat,
    widths: props.widths,
    densities: props.densities
  });
  const imgAdditionalAttributes = {};
  const sourceAdditionalAttributes = {};
  if (props.sizes) {
    sourceAdditionalAttributes.sizes = props.sizes;
  }
  if (fallbackImage.srcSet.values.length > 0) {
    imgAdditionalAttributes.srcset = fallbackImage.srcSet.attribute;
  }
  return renderTemplate`${maybeRenderHead()}<picture${spreadAttributes(pictureAttributes)}> ${Object.entries(optimizedImages).map(([_, image]) => {
    const srcsetAttribute = props.densities || !props.densities && !props.widths ? `${image.src}${image.srcSet.values.length > 0 ? ", " + image.srcSet.attribute : ""}` : image.srcSet.attribute;
    return renderTemplate`<source${addAttribute(srcsetAttribute, "srcset")}${addAttribute("image/" + image.options.format, "type")}${spreadAttributes(sourceAdditionalAttributes)}>`;
  })} <img${addAttribute(fallbackImage.src, "src")}${spreadAttributes(imgAdditionalAttributes)}${spreadAttributes(fallbackImage.attributes)}> </picture>`;
}, "D:/project/version/2/Astro/scooter/node_modules/astro/components/Picture.astro", void 0);

const imageConfig = {"service":{"entrypoint":"astro/assets/services/squoosh","config":{}},"domains":["astro.build"],"remotePatterns":[]};
					const getImage = async (options) => await getImage$1(options, imageConfig);

const Logo = new Proxy({"src":"./assets/images/Logo-B9yU1TGn.png","width":692,"height":500,"format":"png"}, {
						get(target, name, receiver) {
							if (name === 'clone') {
								return structuredClone(target);
							}
							if (name === 'fsPath') {
								return "D:/project/version/2/Astro/scooter/src/assets/images/Logo.png";
							}
							if (target[name] !== undefined) globalThis.astroAsset.referencedImages.add("D:/project/version/2/Astro/scooter/src/assets/images/Logo.png");
							return target[name];
						}
					});

const img = new Proxy({"src":"./assets/images/scooter-3-Jg9eaefn.jpg","width":933,"height":622,"format":"jpg"}, {
						get(target, name, receiver) {
							if (name === 'clone') {
								return structuredClone(target);
							}
							if (name === 'fsPath') {
								return "D:/project/version/2/Astro/scooter/src/assets/images/scooter-3.jpg";
							}
							if (target[name] !== undefined) globalThis.astroAsset.referencedImages.add("D:/project/version/2/Astro/scooter/src/assets/images/scooter-3.jpg");
							return target[name];
						}
					});

const img2 = new Proxy({"src":"./assets/images/scooter-4-Dz3yFJkz.jpg","width":933,"height":622,"format":"jpg"}, {
						get(target, name, receiver) {
							if (name === 'clone') {
								return structuredClone(target);
							}
							if (name === 'fsPath') {
								return "D:/project/version/2/Astro/scooter/src/assets/images/scooter-4.jpg";
							}
							if (target[name] !== undefined) globalThis.astroAsset.referencedImages.add("D:/project/version/2/Astro/scooter/src/assets/images/scooter-4.jpg");
							return target[name];
						}
					});

const HeaderDataClient = [
  {
    title: "الرئيسية",
    path: "/"
  },
  {
    title: "منتجاتنا",
    path: "product.html"
  },
  {
    title: "جحوزاتي",
    path: "MyBook.html"
  },
  {
    title: "من نحن",
    path: "AboutUs.html"
  },
  {
    title: "تواصل معنا",
    path: "ContactUs.html"
  }
];
const HeaderDataAdmin = [
  {
    title: "الرئيسية",
    path: "/"
  },
  {
    title: "العملاء",
    path: "product.html"
  },
  {
    title: "الموظفين",
    path: "scooter.html"
  },
  {
    title: " ادارة الاسكوتر ",
    path: "scooter.html"
  },
  {
    title: "تواصل معنا",
    path: "ContactUs.html"
  }
];
const AboutListData = [
  {
    title: "إلغاء الحجز مجاني لمدة تصل إلى 15 ساعة"
  },
  {
    title: "أكثر من 350.000 عميل راضٍ"
  },
  {
    title: "نحن نقدم المساعدة في تأجير الطرق على مدار الساعة طوال أيام الأسبوع"
  },
  {
    title: "أسطول يضم أكثر من 8000 دراجة نارية ودراجة نارية جديدة"
  }
];
const CardDate = [
  {
    title: "Metric  ES150 سكوتر",
    img: img,
    price: "50",
    model: "موديل 2024",
    color: "اسود",
    des: "يتميز سكوتر Metric ES150 بتصميم أنيق وعصري، يهدف إلى توفير الجمال والأداء الوظيفي. يشتمل تركيبها على مواد خفيفة الوزن من أجل خفة الحركة والقدرة على المناورة مع الحفاظ على المتانة والاستقرار.",
    available: true
  },
  {
    title: "Minar Maxi سكوتر",
    img: img2,
    price: "50",
    model: "موديل 2023",
    color: "اخضر",
    des: "يتميز سكوتر Minar Maxi بتصميم أنيق وعصري، يهدف إلى توفير الجمال والأداء الوظيفي. يشتمل تركيبها على مواد خفيفة الوزن من أجل خفة الحركة والقدرة على المناورة مع الحفاظ على المتانة والاستقرار.",
    available: false
  },
  {
    title: "Jambretta 125 سكوتر",
    img: img,
    price: "50",
    model: "موديل 2022",
    color: "اسود",
    des: "يتميز سكوتر Jambretta 125 بتصميم أنيق وعصري، يهدف إلى توفير الجمال والأداء الوظيفي. يشتمل تركيبها على مواد خفيفة الوزن من أجل خفة الحركة والقدرة على المناورة مع الحفاظ على المتانة والاستقرار.",
    available: true
  },
  {
    title: "Skupi سكوتر",
    img: img2,
    price: "50",
    model: "موديل 2020",
    color: "ازرق",
    des: "يتميز سكوتر Skupi بتصميم أنيق وعصري، يهدف إلى توفير الجمال والأداء الوظيفي. يشتمل تركيبها على مواد خفيفة الوزن من أجل خفة الحركة والقدرة على المناورة مع الحفاظ على المتانة والاستقرار.",
    available: false
  },
  {
    title: "Metric  ES150 سكوتر",
    img: img,
    price: "50",
    model: "موديل 2024",
    color: "اسود",
    des: "يتميز سكوتر Metric ES150 بتصميم أنيق وعصري، يهدف إلى توفير الجمال والأداء الوظيفي. يشتمل تركيبها على مواد خفيفة الوزن من أجل خفة الحركة والقدرة على المناورة مع الحفاظ على المتانة والاستقرار.",
    available: true
  },
  {
    title: "Minar Maxi سكوتر",
    img: img2,
    price: "50",
    model: "موديل 2023",
    color: "اخضر",
    des: "يتميز سكوتر Minar Maxi بتصميم أنيق وعصري، يهدف إلى توفير الجمال والأداء الوظيفي. يشتمل تركيبها على مواد خفيفة الوزن من أجل خفة الحركة والقدرة على المناورة مع الحفاظ على المتانة والاستقرار.",
    available: true
  },
  {
    title: "Jambretta 125 سكوتر",
    img: img,
    price: "50",
    model: "موديل 2022",
    color: "اسود",
    des: "يتميز سكوتر Jambretta 125 بتصميم أنيق وعصري، يهدف إلى توفير الجمال والأداء الوظيفي. يشتمل تركيبها على مواد خفيفة الوزن من أجل خفة الحركة والقدرة على المناورة مع الحفاظ على المتانة والاستقرار.",
    available: false
  },
  {
    title: "Skupi سكوتر",
    img: img2,
    price: "50",
    model: "موديل 2020",
    color: "ازرق",
    des: "يتميز سكوتر Skupi بتصميم أنيق وعصري، يهدف إلى توفير الجمال والأداء الوظيفي. يشتمل تركيبها على مواد خفيفة الوزن من أجل خفة الحركة والقدرة على المناورة مع الحفاظ على المتانة والاستقرار.",
    available: true
  }
];
const footerFollow = [
  {
    title: "فيسبوك",
    path: "#!"
  },
  {
    title: "انستجرام",
    path: "#!"
  },
  {
    title: "تويتر",
    path: "#!"
  }
];
const footerContact = [
  {
    title: "scooter@gmail.com",
    path: "#!"
  },
  {
    title: "scooterhelp@gmail.com",
    path: "#!"
  }
];

const $$Astro$w = createAstro();
const $$NavList = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$w, $$props, $$slots);
  Astro2.self = $$NavList;
  const { Client, Admin, job } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<ul${addAttribute(["link-list d-flex mx-auto normalMenu", `${Client === true ? "client" : ""} ${Admin === true ? "Admin" : ""}`], "class:list")}> ${Client && HeaderDataClient.map((link) => renderTemplate`<li class="navItems"> <a${addAttribute(link.path, "href")} class="navLink fw-700 relative"> ${" "} ${link.title}${" "} </a> </li>`)} ${Admin && HeaderDataAdmin.map((link) => renderTemplate`<li class="navItems"> <a${addAttribute(link.path, "href")} class="navLink"> ${" "} ${link.title}${" "} </a> </li>`)} </ul>`;
}, "D:/project/version/2/Astro/scooter/src/components/header/NavList.astro", void 0);

const $$Astro$v = createAstro();
const $$Button = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$v, $$props, $$slots);
  Astro2.self = $$Button;
  const { ClassName, type, aria, id, ariaEx } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<button${addAttribute(`btn ${ClassName}`, "class:list")}${addAttribute(type, "type")}${addAttribute(aria, "aria-label")}${addAttribute(id, "id")}${addAttribute(ariaEx, "aria-expanded")}> ${renderSlot($$result, $$slots["default"])} </button>`;
}, "D:/project/version/2/Astro/scooter/src/components/ui/Button.astro", void 0);

const $$Astro$u = createAstro();
const $$Header = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$u, $$props, $$slots);
  Astro2.self = $$Header;
  const { Client, Admin, job } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<header> <div class="container"> <nav class="d-flex items-center py-4 justify-between"> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "open menu", "ClassName": "icon-nav-base", "ariaEx": "false" }, { "default": ($$result2) => renderTemplate` <span></span><span></span><span></span> ` })} <a href="/" class="logo"> ${renderComponent($$result, "Image", $$Image, { "src": Logo, "alt": "scooter logo", "quality": 50, "format": "webp" })} </a> ${renderComponent($$result, "NavList", $$NavList, { "Client": Client, "Admin": Admin, "job": job })} ${Client && renderTemplate`${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "\u0627\u062D\u062C\u0632 \u0627\u0644\u0627\u0646", "ClassName": "btn-certain  relative round-6 " }, { "default": ($$result2) => renderTemplate`${" "}<a href="product.html" class="fs-18 fw-700 px-10 py-4">احجز الان</a> ` })}`} </nav> </div> </header>`;
}, "D:/project/version/2/Astro/scooter/src/components/header/Header.astro", void 0);

const logoFooter = new Proxy({"src":"./assets/images/LogoFooter-VjNDGDik.png","width":692,"height":500,"format":"png"}, {
						get(target, name, receiver) {
							if (name === 'clone') {
								return structuredClone(target);
							}
							if (name === 'fsPath') {
								return "D:/project/version/2/Astro/scooter/src/assets/images/LogoFooter.png";
							}
							if (target[name] !== undefined) globalThis.astroAsset.referencedImages.add("D:/project/version/2/Astro/scooter/src/assets/images/LogoFooter.png");
							return target[name];
						}
					});

const $$Astro$t = createAstro();
const $$Footer = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$t, $$props, $$slots);
  Astro2.self = $$Footer;
  const { Client, Admin, job } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<footer> <div class="container"> <div class="row gap-row-1 items-start"> <div class="col-3-lg col-6-md col-12-sm"> <ul class="footerLinks"> <!-- img --> <li class="imgContainer mb-8"> ${renderComponent($$result, "Image", $$Image, { "src": logoFooter, "alt": `scooter logo`, "format": "webp", "quality": 70 })} </li> <li class="des line-big">
اول موقع في الوطن العربي يتح لك تاجير كافة انواع الاسكوتر بارخص
            الاسعار
</li> </ul> </div> <div class="col-3-lg col-6-md col-12-sm"> <ul class="footerLinks text-center"> <p class="title fs-24 fw-900 mb-8">روابط سريعة</p> ${Client && HeaderDataClient.map((li) => renderTemplate`<li class="pb-5"> <a${addAttribute(li.path, "href")}>${li.title}</a> </li>`)} ${Admin && HeaderDataAdmin.map((li) => renderTemplate`<li> <a class="pb-5"${addAttribute(li.path, "href")}>${li.title}</a> </li>`)} </ul> </div> <div class="col-3-lg col-6-md col-12-sm"> <ul class="footerLinks text-center"> <p class="title fs-24 fw-900 mb-8"> تابعنا </p> ${footerFollow.map((li) => renderTemplate`<li class="pb-5"> <a${addAttribute(li.path, "href")}>${li.title}</a> </li>`)} </ul> </div> <div class="col-3-lg col-6-md col-12-sm"> <ul class="footerLinks text-center"> <p class="title fs-24 fw-900 mb-8"> تواصل معنا </p> ${footerContact.map((li) => renderTemplate`<li class="pb-5"> <a${addAttribute(li.path, "href")}>${li.title}</a> </li>`)} </ul> </div> </div> </div> </footer>`;
}, "D:/project/version/2/Astro/scooter/src/components/footer/footer.astro", void 0);

const $$Astro$s = createAstro();
const $$Layout = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$s, $$props, $$slots);
  Astro2.self = $$Layout;
  const { title, des } = Astro2.props;
  return renderTemplate`<html lang="ar"> <head>${renderComponent($$result, "BaseHead", $$BaseHead, { "title": title, "description": des })}${renderHead()}</head> <body> ${renderComponent($$result, "Header", $$Header, { "Client": true, "Admin": false, "job": false })} <main> ${renderSlot($$result, $$slots["default"])} </main> ${renderComponent($$result, "Footer", $$Footer, { "Client": true, "Admin": false, "job": false })}  </body> </html>`;
}, "D:/project/version/2/Astro/scooter/src/layouts/Layout.astro", void 0);

const breackjumb = new Proxy({"src":"./assets/images/breackjumb-G3h1X0WW.jpg","width":1920,"height":1199,"format":"jpg"}, {
						get(target, name, receiver) {
							if (name === 'clone') {
								return structuredClone(target);
							}
							if (name === 'fsPath') {
								return "D:/project/version/2/Astro/scooter/src/assets/images/breackjumb.jpg";
							}
							if (target[name] !== undefined) globalThis.astroAsset.referencedImages.add("D:/project/version/2/Astro/scooter/src/assets/images/breackjumb.jpg");
							return target[name];
						}
					});

const $$Astro$r = createAstro();
const $$Breadcrumb = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$r, $$props, $$slots);
  Astro2.self = $$Breadcrumb;
  const { linkPage, defPage, path } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<section class="breadcrumb d-flex items-center justify-center relative overflow-hidden"> <div class="imgContainer absolute "> ${renderComponent($$result, "Image", $$Image, { "src": breackjumb, "alt": `breackjumb image`, "quality": 50, "format": "webp", "class": `img-cover` })} </div> <div class="container "> <ul class="d-flex items-center justify-center relative"> <li class="linkPage">${linkPage}</li> <li class="separator mx-4"> | </li> <li class="defPage "> <a${addAttribute(path, "href")} class=""> ${defPage} </a> </li> </ul> <h1 class="title capitalize  text-center fs-r-48 fw-900  relative"> ${linkPage} </h1> </div> </section>`;
}, "D:/project/version/2/Astro/scooter/src/components/ui/breadcrumb.astro", void 0);

const icons = {"local":{"prefix":"local","lastModified":1712600317,"icons":{"arrow-down":{"body":"<path fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"m7 10 5 5 5-5\"/>"},"arrow-left":{"body":"<path fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M10 6 2 16l8 10M2 16h28\"/>","width":32,"height":32},"cart2":{"body":"<circle cx=\"176\" cy=\"416\" r=\"32\" fill=\"currentColor\"/><circle cx=\"400\" cy=\"416\" r=\"32\" fill=\"currentColor\"/><path fill=\"currentColor\" d=\"M167.78 304h261.34l38.4-192H133.89l-8.47-48H32v32h66.58l48 272H432v-32H173.42z\"/>","width":512,"height":512},"close":{"body":"<path fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M6 18 18 6m0 12L6 6\"/>"},"delete":{"body":"<path fill=\"currentColor\" d=\"M19 4h-3.5l-1-1h-5l-1 1H5v2h14M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6z\"/>"},"facebook":{"body":"<path fill=\"currentColor\" d=\"M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.557-.14-2.857-.14C11.928 2 10 3.657 10 6.7v2.8H7v4h3V22h4z\"/>"},"inst":{"body":"<path fill=\"currentColor\" d=\"M12.001 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6m0-2a5 5 0 1 1 0 10 5 5 0 0 1 0-10m6.5-.25a1.25 1.25 0 0 1-2.5 0 1.25 1.25 0 0 1 2.5 0M12.001 4c-2.474 0-2.878.007-4.029.058-.784.037-1.31.142-1.798.332a2.886 2.886 0 0 0-1.08.703 2.89 2.89 0 0 0-.704 1.08c-.19.49-.295 1.015-.331 1.798C4.007 9.075 4 9.461 4 12c0 2.475.007 2.878.058 4.029.037.783.142 1.31.331 1.797.17.435.37.748.702 1.08.337.336.65.537 1.08.703.494.191 1.02.297 1.8.333C9.075 19.994 9.461 20 12 20c2.475 0 2.878-.007 4.029-.058.782-.037 1.308-.142 1.797-.331a2.91 2.91 0 0 0 1.08-.703c.337-.336.538-.649.704-1.08.19-.492.296-1.018.332-1.8.052-1.103.058-1.49.058-4.028 0-2.474-.007-2.878-.058-4.029-.037-.782-.143-1.31-.332-1.798a2.912 2.912 0 0 0-.703-1.08 2.884 2.884 0 0 0-1.08-.704c-.49-.19-1.016-.295-1.798-.331C14.926 4.006 14.54 4 12 4m0-2c2.717 0 3.056.01 4.123.06 1.064.05 1.79.217 2.427.465.66.254 1.216.598 1.772 1.153a4.908 4.908 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.218 1.79-.465 2.428a4.884 4.884 0 0 1-1.153 1.772 4.915 4.915 0 0 1-1.772 1.153c-.637.247-1.363.415-2.427.465-1.067.047-1.406.06-4.123.06-2.717 0-3.056-.01-4.123-.06-1.064-.05-1.789-.218-2.427-.465a4.89 4.89 0 0 1-1.772-1.153 4.905 4.905 0 0 1-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.012 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.065.217-1.79.465-2.428a4.88 4.88 0 0 1 1.153-1.772A4.897 4.897 0 0 1 5.45 2.525c.637-.248 1.362-.415 2.427-.465C8.945 2.013 9.284 2 12.001 2\"/>"},"rate":{"body":"<path fill=\"currentColor\" d=\"m5.825 21 2.325-7.6L2 9h7.6L12 1l2.4 8H22l-6.15 4.4 2.325 7.6L12 16.3z\"/>"},"scooter":{"body":"<path fill=\"#ea6c3a\" d=\"M109.4 59.1h8.8c2 0 3.5 1.6 3.5 3.5 0 2-1.6 3.5-3.5 3.5h-8.8z\"/><path fill=\"#fac136\" d=\"M29.6 25.3c-.4 2.8-1.1 8.1-1.5 10.9-.2 1.1-1.4 1.8-2.4 1.3-2.9-1.4-4.7-4.5-4.2-7.8s3.1-5.8 6.2-6.4c1.1-.2 2.1.8 1.9 2\"/><circle cx=\"19.4\" cy=\"90.2\" r=\"17.5\" fill=\"#2f2f2f\"/><circle cx=\"19.4\" cy=\"90.2\" r=\"9.7\" fill=\"#65878d\"/><circle cx=\"97.7\" cy=\"90.2\" r=\"17.5\" fill=\"#2f2f2f\"/><circle cx=\"97.7\" cy=\"90.2\" r=\"9.7\" fill=\"#65878d\"/><path fill=\"#47c0e5\" d=\"M95.7 54.7h.2c2.1.1 31.3 2.8 31.3 34.6 0 1.9-1.6 3.5-3.5 3.5H51.6c-7.6 0-14.7-3.3-19.7-9l-9.6-11.1c-1.3-1.5-1.8-3.5-1.4-5.5 2-9.1 5.9-17.7 11.6-25.2l1.8-2.4h7.5l-7 28.9c.5 8.7 7.8 15.5 16.5 15.6h12.3c5.6 0 10.1-4.5 10.1-10.1 0-3.5-1.8-6.7-4.8-8.6L63 61.7c-1.2-.8-2-2.2-2-3.6v-3.5h34.7z\"/><path fill=\"#bae9f3\" d=\"M94.6 62.1c-.1 0-.1 0 0 0-.8 0-1.4.7-1.4 1.4 0 .8.6 1.4 1.4 1.4 12.3 0 22.2 9.9 22.2 22.2 0 .8.6 1.4 1.4 1.4.8 0 1.4-.6 1.4-1.4 0-13.8-11.2-25-25-25\"/><path fill=\"#2f2f2f\" d=\"M66.2 58.5 61 56.1c-.8-.4-1.3-1.2-1.3-2 0-4.7 3.8-8.6 8.6-8.6h14.5c4.9 0 9.9-.3 14.8-1 4.8-.4 8.8 3.4 8.8 8.2v3.4c0 1.1-.9 2.1-2.1 2.1l-30.8 1.3c-2.5.5-5 .1-7.3-1m43.5-31.1-.1.2c-1.8 2.7-2.8 5.8-2.8 9v2c0 .9.6 1.8 1.5 2.1l1.2.4c1.1.3 2.3-.3 2.7-1.4l3-9.9c.4-1.2-.3-2.4-1.5-2.7l-1.7-.5c-.9-.3-1.8 0-2.3.8\"/><path fill=\"#2f2f2f\" d=\"M115.5 30c.6.2.9.8.7 1.4l-5.7 20.2c-.5 1.9-2 3.5-3.8 4.2l-2.5 1v-2.5l.6-.2c2-.7 3.5-2.3 4.1-4.4l5.2-19c.2-.5.8-.9 1.4-.7\"/><path fill=\"#47c0e5\" d=\"M42.7 37.4 44 33c.4-1.2 0-2.6-1-3.4L38.8 26c-1.7-1.4-3.8-2.3-6-2.5l-6.5-.5c-.5 0-.9.2-1.1.6l-.8 1.8c-1.3 2.9-1.9 6-1.7 9.1l.1 1.7c0 .5.4.9.9 1l4.3.6c3.4.5 5.5 4 4.2 7.3l8.6-1.7z\"/><path fill=\"#2f2f2f\" d=\"M38.4 26s-1.8-.8-2.8 1.7c-1 2.4 1.1 4.6 1.1 4.6l7.5 2.5c1.5.5 3.1-.5 3.4-2.1.2-1.1-.4-2.2-1.4-2.7z\"/><path fill=\"#47c0e5\" d=\"M3 83.7h4.5c10.3.1 20.3 3.4 28.8 9.4 1.4 1 3.3-.1 3.2-1.9-.1-2.2-.5-5.2-1.6-8.3-2-6-6.2-11.3-12.8-13.1-13.7-3.7-21 5.5-23.9 10.6-.7 1.6.3 3.3 1.8 3.3\"/><path fill=\"none\" stroke=\"#bae9f3\" stroke-linecap=\"round\" stroke-miterlimit=\"10\" stroke-width=\"2.5\" d=\"M15 74.4s7.2-2.4 13.1 2.1c4 3 5.3 7.3 5.3 7.3\"/>","width":128,"height":128},"twitter":{"body":"<path fill=\"currentColor\" d=\"M5.026 15c6.038 0 9.341-5.003 9.341-9.334q.002-.211-.006-.422A6.7 6.7 0 0 0 16 3.542a6.7 6.7 0 0 1-1.889.518 3.3 3.3 0 0 0 1.447-1.817 6.5 6.5 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.32 9.32 0 0 1-6.767-3.429 3.29 3.29 0 0 0 1.018 4.382A3.3 3.3 0 0 1 .64 6.575v.045a3.29 3.29 0 0 0 2.632 3.218 3.2 3.2 0 0 1-.865.115 3 3 0 0 1-.614-.057 3.28 3.28 0 0 0 3.067 2.277A6.6 6.6 0 0 1 .78 13.58a6 6 0 0 1-.78-.045A9.34 9.34 0 0 0 5.026 15\"/>","width":16,"height":16},"user":{"body":"<path fill=\"currentColor\" d=\"M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5M20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1z\"/>"}},"width":24,"height":24}};

const cache = /* @__PURE__ */ new WeakMap();

const $$Astro$q = createAstro();
const $$Icon = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$q, $$props, $$slots);
  Astro2.self = $$Icon;
  class AstroIconError extends Error {
    constructor(message) {
      super(message);
    }
  }
  const req = Astro2.request;
  const { name = "", title, "is:inline": inline = false, ...props } = Astro2.props;
  const map = cache.get(req) ?? /* @__PURE__ */ new Map();
  const i = map.get(name) ?? 0;
  map.set(name, i + 1);
  cache.set(req, map);
  const includeSymbol = !inline && i === 0;
  let [setName, iconName] = name.split(":");
  if (!setName && iconName) {
    const err = new AstroIconError(`Invalid "name" provided!`);
    throw err;
  }
  if (!iconName) {
    iconName = setName;
    setName = "local";
    if (!icons[setName]) {
      const err = new AstroIconError('Unable to load the "local" icon set!');
      throw err;
    }
    if (!(iconName in icons[setName].icons)) {
      const err = new AstroIconError(`Unable to locate "${name}" icon!`);
      throw err;
    }
  }
  const collection = icons[setName];
  if (!collection) {
    const err = new AstroIconError(`Unable to locate the "${setName}" icon set!`);
    throw err;
  }
  const iconData = getIconData(collection, iconName ?? setName);
  if (!iconData) {
    const err = new AstroIconError(`Unable to locate "${name}" icon!`);
    throw err;
  }
  const id = `ai:${collection.prefix}:${iconName ?? setName}`;
  if (props.size) {
    props.width = props.size;
    props.height = props.size;
    delete props.size;
  }
  const renderData = iconToSVG(iconData);
  const normalizedProps = { ...renderData.attributes, ...props };
  const normalizedBody = renderData.body;
  return renderTemplate`${maybeRenderHead()}<svg${spreadAttributes(normalizedProps)}${addAttribute(name, "data-icon")}> ${title && renderTemplate`<title>${title}</title>`} ${inline ? renderTemplate`${renderComponent($$result, "Fragment", Fragment, { "id": id }, { "default": ($$result2) => renderTemplate`${unescapeHTML(normalizedBody)}` })}` : renderTemplate`${renderComponent($$result, "Fragment", Fragment, {}, { "default": ($$result2) => renderTemplate`${includeSymbol && renderTemplate`<symbol${addAttribute(id, "id")}>${unescapeHTML(normalizedBody)}</symbol>`}<use${addAttribute(`#${id}`, "xlink:href")}></use> ` })}`} </svg>`;
}, "D:/project/version/2/Astro/scooter/node_modules/astro-icon/components/Icon.astro", void 0);

const $$Astro$p = createAstro();
const $$MainHeadingDes = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$p, $$props, $$slots);
  Astro2.self = $$MainHeadingDes;
  const { isSub, title, sub, position } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<div${addAttribute(`mainHeading d-flex  justify-center ${position} `, "class")}> ${isSub && renderTemplate`<p class="subHead d-flex items-center fs-20"> ${sub} ${renderComponent($$result, "Icon", $$Icon, { "name": `scooter`, "class": `mr-4` })} </p>`} <h2 class="mainHead fs-r-36"> ${title} </h2> </div>`;
}, "D:/project/version/2/Astro/scooter/src/components/ui/MainHeading_des.astro", void 0);

const $$Astro$o = createAstro();
const $$AboutUl = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$o, $$props, $$slots);
  Astro2.self = $$AboutUl;
  return renderTemplate`${maybeRenderHead()}<ul> ${AboutListData.map((li) => renderTemplate`<li class="fw-900 fs-18 pb-8 pr-11"> ${li.title} </li>`)} </ul>`;
}, "D:/project/version/2/Astro/scooter/src/components/About/AboutUl.astro", void 0);

const AboutImg = new Proxy({"src":"./assets/images/About-Bbcypqxt.jpg","width":480,"height":616,"format":"jpg"}, {
						get(target, name, receiver) {
							if (name === 'clone') {
								return structuredClone(target);
							}
							if (name === 'fsPath') {
								return "D:/project/version/2/Astro/scooter/src/assets/images/About.jpg";
							}
							if (target[name] !== undefined) globalThis.astroAsset.referencedImages.add("D:/project/version/2/Astro/scooter/src/assets/images/About.jpg");
							return target[name];
						}
					});

const $$Astro$n = createAstro();
const $$AboutSection = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$n, $$props, $$slots);
  Astro2.self = $$AboutSection;
  const { isAboutPage } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<section class="about"> <div class="container"> <div class="row "> <!-- right-text --> <div class="col-7-lg co-6-md col-12-sm"> <div class="aboutDetails"> ${renderComponent($$result, "MainHeadingDes", $$MainHeadingDes, { "title": "\u062E\u062F\u0645\u0629 \u062A\u0623\u062C\u064A\u0631 \u0627\u0644\u062F\u0631\u0627\u062C\u0627\u062A \u0633\u0647\u0644\u0629", "sub": "\u0627\u0639\u0631\u0641 \u0639\u0646\u0627", "isSub": true, "position": "items-start" })} <!-- des --> <p class="py-10 fs-16 fw-700 line-big">
استكشف المدينة دون عناء مع خدمة تأجير السكوتر لدينا. بأسعار معقولة
            وموثوقة ومريحة، نحن نقدم أسطولًا من الدراجات البخارية التي يتم
            صيانتها جيدًا لمغامرة حضرية لا تُنسى.
</p> <!-- ul --> ${renderComponent($$result, "AboutUl", $$AboutUl, {})} <!-- btn --> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "on read", "ClassName": "btn-base round-6 mt-14 max-mb-10" }, { "default": ($$result2) => renderTemplate` <a${addAttribute(isAboutPage ? `AboutUs.html` : "signUp.html", "href")} class="px-14 py-5 fs-18 fw-700 "> ${isAboutPage ? "  \u0648\u0627\u0635\u0644 \u0627\u0644\u0642\u0631\u0627\u0621\u0629" : "\u0627\u0646\u0636\u0645 \u0627\u0644\u064A\u0646\u0627"} </a> ` })} </div> </div> <!-- left-img --> <div class="col-5-lg co-6-md col-12-sm"> <div class="imgContainer"> ${renderComponent($$result, "Image", $$Image, { "src": AboutImg, "alt": `about img `, "format": "webp", "quality": 100, "class": `round-6` })} </div> </div> </div> </div> </section>`;
}, "D:/project/version/2/Astro/scooter/src/components/About/AboutSection.astro", void 0);

const $$Astro$m = createAstro();
const $$AboutUs = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$m, $$props, $$slots);
  Astro2.self = $$AboutUs;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Scooter | \u0645\u0646 \u0646\u062D\u0646", "des": "\u062A\u0648\u0641\u0631 \u062E\u062F\u0645\u0627\u062A \u062A\u0623\u062C\u064A\u0631 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0641\u064A \u0627\u0644\u0639\u0627\u0644\u0645 \u0627\u0644\u0639\u0631\u0628\u064A \u062E\u064A\u0627\u0631\u0627\u062A \u0646\u0642\u0644 \u0645\u0631\u064A\u062D\u0629 \u0648\u0635\u062F\u064A\u0642\u0629 \u0644\u0644\u0628\u064A\u0626\u0629 \u0644\u0644\u062A\u0646\u0642\u0644 \u0641\u064A \u0627\u0644\u0645\u0646\u0627\u0637\u0642 \u0627\u0644\u062D\u0636\u0631\u064A\u0629. \u0648\u064A\u0645\u0643\u0646 \u0644\u0644\u0645\u0633\u062A\u062E\u062F\u0645\u064A\u0646 \u0628\u0633\u0647\u0648\u0644\u0629 \u062A\u062D\u062F\u064A\u062F \u0645\u0648\u0642\u0639 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0627\u0644\u0643\u0647\u0631\u0628\u0627\u0626\u064A \u0648\u0641\u062A\u062D\u0647 \u0628\u0627\u0633\u062A\u062E\u062F\u0627\u0645 \u062A\u0637\u0628\u064A\u0642\u0627\u062A \u0627\u0644\u0647\u0648\u0627\u062A\u0641 \u0627\u0644\u0630\u0643\u064A\u0629\u060C \u0645\u0645\u0627 \u064A\u0639\u0632\u0632 \u0627\u0644\u062A\u0646\u0642\u0644 \u0627\u0644\u0645\u0633\u062A\u062F\u0627\u0645 \u0648\u064A\u0642\u0644\u0644 \u0627\u0644\u0627\u0632\u062F\u062D\u0627\u0645 \u0627\u0644\u0645\u0631\u0648\u0631\u064A. \u0627\u0633\u062A\u0643\u0634\u0641 \u0627\u0644\u0627\u0633\u062A\u0643\u0634\u0627\u0641 \u0627\u0644\u062D\u0636\u0631\u064A \u0627\u0644\u062E\u0627\u0644\u064A \u0645\u0646 \u0627\u0644\u0645\u062A\u0627\u0639\u0628 \u0645\u0639 \u062A\u0623\u062C\u064A\u0631 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0641\u064A \u0645\u062F\u0646 \u0627\u0644\u0639\u0627\u0644\u0645 \u0627\u0644\u0639\u0631\u0628\u064A." }, { "default": ($$result2) => renderTemplate` ${renderComponent($$result2, "Breadcrumb", $$Breadcrumb, { "linkPage": "\u0645\u0646 \u0646\u062D\u0646", "defPage": "\u0627\u0644\u0631\u0626\u064A\u0633\u064A\u0629", "path": "/" })} ${renderComponent($$result2, "AboutSection", $$AboutSection, { "isAboutPage": false })} ` })}`;
}, "D:/project/version/2/Astro/scooter/src/pages/AboutUs.astro", void 0);

const $$file$7 = "D:/project/version/2/Astro/scooter/src/pages/AboutUs.astro";
const $$url$7 = "/AboutUs.html";

const AboutUs = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$AboutUs,
  file: $$file$7,
  url: $$url$7
}, Symbol.toStringTag, { value: 'Module' }));

const $$Astro$l = createAstro();
const $$FormGroup = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$l, $$props, $$slots);
  Astro2.self = $$FormGroup;
  const { title, name, type, place, value, isDisabled, isLabel = true, ClassName } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<div class="formGroup relative mb-7 d-flex"> ${isLabel && renderTemplate`<label${addAttribute(name, "for")} class="">${title}</label>`} <input${addAttribute(type, "type")}${addAttribute(name, "name")}${addAttribute(name, "id")}${addAttribute(`round-4 pr-5 pl-5 ${ClassName}`, "class")}${addAttribute(place, "placeholder")}${addAttribute(value, "value")}${addAttribute(isDisabled, "disabled")}> </div>`;
}, "D:/project/version/2/Astro/scooter/src/components/ui/FormGroup.astro", void 0);

const $$Astro$k = createAstro();
const $$Contact = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$k, $$props, $$slots);
  Astro2.self = $$Contact;
  return renderTemplate`${maybeRenderHead()}<section class="contact"> <div class="container"> ${renderComponent($$result, "MainHeadingDes", $$MainHeadingDes, { "title": "\u0627\u0628\u0642\u0627 \u0639\u0644\u064A \u0627\u062A\u0635\u0627\u0644\u0643 \u0645\u0639\u0646\u0627", "sub": "\u0627\u062A\u0635\u0644 \u0628\u0646\u0627", "isSub": true, "position": "items-center" })} <form action="" class="mx-auto round-6"> <div class="row gap-row-1"> <div class="col-6-lg col-6-md col-12-sm"> ${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "text", "place": "\u0627\u062F\u062E\u0644 \u0627\u0644\u0627\u0633\u0645 \u0628\u0627\u0644\u0643\u0627\u0645\u0644", "title": "\u0627\u0644\u0627\u0633\u0645 \u0628\u0627\u0644\u0643\u0627\u0645\u0644", "name": "userName", "isLabel": false })} </div> <div class="col-6-lg col-6-md col-12-sm"> ${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "email", "place": "\u0627\u062F\u062E\u0644  \u0627\u0644\u0628\u0631\u064A\u062F \u0627\u0644\u0627\u0644\u0643\u062A\u0631\u0648\u0646\u064A", "title": "\u0627\u0644\u0628\u0631\u064A\u062F \u0627\u0644\u0627\u0644\u0643\u062A\u0631\u0648\u0646\u064A", "name": "userEmail", "isLabel": false })} </div> <div class="col-6-lg col-6-md col-12-sm"> ${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "number", "place": "\u0627\u062F\u062E\u0644  \u0631\u0642\u0645 \u0627\u0644\u0647\u0627\u062A\u0641", "title": "\u0631\u0642\u0645 \u0627\u0644\u0647\u0627\u062A\u0641", "name": "userPhone", "isLabel": false })} </div> <div class="col-6-lg col-6-md col-12-sm"> ${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "text", "place": "\u0627\u062F\u062E\u0644  \u0645\u0648\u0636\u0648\u0639  \u0627\u0644\u0631\u0633\u0627\u0644\u0629", "title": "\u0645\u0648\u0636\u0648\u0639 \u0627\u0644\u0631\u0633\u0627\u0644\u0629", "name": "userSubject", "isLabel": false })} </div> </div> <div class="formGroup"> <textarea name="Usermassage" id="Usermassage" placeholder="ادخل رسالتك" class="pr-5 pt-5 relative mb-7 d-flex round-4"></textarea> </div> <div class="d-flex items-center justify-center mx-auto"> ${renderComponent($$result, "Button", $$Button, { "type": "submit", "aria": "contactus form", "ClassName": "btn-base px-12 py-5 round-4" }, { "default": ($$result2) => renderTemplate`ارسال` })} </div> </form> </div> </section>`;
}, "D:/project/version/2/Astro/scooter/src/components/contact/Contact.astro", void 0);

const $$Astro$j = createAstro();
const $$ContactUs = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$j, $$props, $$slots);
  Astro2.self = $$ContactUs;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Scooter | \u062A\u0648\u0627\u0635\u0644 \u0645\u0639\u0646\u0627 ", "des": "\u062A\u0648\u0641\u0631 \u062E\u062F\u0645\u0627\u062A \u062A\u0623\u062C\u064A\u0631 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0641\u064A \u0627\u0644\u0639\u0627\u0644\u0645 \u0627\u0644\u0639\u0631\u0628\u064A \u062E\u064A\u0627\u0631\u0627\u062A \u0646\u0642\u0644 \u0645\u0631\u064A\u062D\u0629 \u0648\u0635\u062F\u064A\u0642\u0629 \u0644\u0644\u0628\u064A\u0626\u0629 \u0644\u0644\u062A\u0646\u0642\u0644 \u0641\u064A \u0627\u0644\u0645\u0646\u0627\u0637\u0642 \u0627\u0644\u062D\u0636\u0631\u064A\u0629. \u0648\u064A\u0645\u0643\u0646 \u0644\u0644\u0645\u0633\u062A\u062E\u062F\u0645\u064A\u0646 \u0628\u0633\u0647\u0648\u0644\u0629 \u062A\u062D\u062F\u064A\u062F \u0645\u0648\u0642\u0639 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0627\u0644\u0643\u0647\u0631\u0628\u0627\u0626\u064A \u0648\u0641\u062A\u062D\u0647 \u0628\u0627\u0633\u062A\u062E\u062F\u0627\u0645 \u062A\u0637\u0628\u064A\u0642\u0627\u062A \u0627\u0644\u0647\u0648\u0627\u062A\u0641 \u0627\u0644\u0630\u0643\u064A\u0629\u060C \u0645\u0645\u0627 \u064A\u0639\u0632\u0632 \u0627\u0644\u062A\u0646\u0642\u0644 \u0627\u0644\u0645\u0633\u062A\u062F\u0627\u0645 \u0648\u064A\u0642\u0644\u0644 \u0627\u0644\u0627\u0632\u062F\u062D\u0627\u0645 \u0627\u0644\u0645\u0631\u0648\u0631\u064A. \u0627\u0633\u062A\u0643\u0634\u0641 \u0627\u0644\u0627\u0633\u062A\u0643\u0634\u0627\u0641 \u0627\u0644\u062D\u0636\u0631\u064A \u0627\u0644\u062E\u0627\u0644\u064A \u0645\u0646 \u0627\u0644\u0645\u062A\u0627\u0639\u0628 \u0645\u0639 \u062A\u0623\u062C\u064A\u0631 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0641\u064A \u0645\u062F\u0646 \u0627\u0644\u0639\u0627\u0644\u0645 \u0627\u0644\u0639\u0631\u0628\u064A." }, { "default": ($$result2) => renderTemplate` ${renderComponent($$result2, "Breadcrumb", $$Breadcrumb, { "linkPage": "\u062A\u0648\u0627\u0635\u0644 \u0645\u0639\u0646\u0627 ", "defPage": "\u0627\u0644\u0631\u0626\u064A\u0633\u064A\u0629", "path": "/" })} ${renderComponent($$result2, "Contact", $$Contact, {})} ` })}`;
}, "D:/project/version/2/Astro/scooter/src/pages/ContactUs.astro", void 0);

const $$file$6 = "D:/project/version/2/Astro/scooter/src/pages/ContactUs.astro";
const $$url$6 = "/ContactUs.html";

const ContactUs = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$ContactUs,
  file: $$file$6,
  url: $$url$6
}, Symbol.toStringTag, { value: 'Module' }));

const $$Astro$i = createAstro();
const $$Auth = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$i, $$props, $$slots);
  Astro2.self = $$Auth;
  const { isLogin } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<section${addAttribute(`Auth ${isLogin ? "login" : "signIn"}`, "class")}> <div class="container"> ${renderComponent($$result, "MainHeadingDes", $$MainHeadingDes, { "title": `${isLogin ? "\u062A\u0633\u062C\u064A\u0644 \u0627\u0644\u062F\u062E\u0648\u0644" : "\u0627\u0646\u0634\u0627\u0621 \u062D\u0633\u0627\u0628"}`, "isSub": false, "position": "items-center", "sub": "" })} <form action="" class="mx-auto round-6"> ${!isLogin && renderTemplate`${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "file", "place": "", "title": "", "name": "userName", "isLabel": false })}
          ${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "text", "place": "\u0627\u062F\u062E\u0644  \u0627\u0644\u0627\u0633\u0645 \u0628\u0627\u0644\u0643\u0627\u0645\u0644", "title": " \u0627\u0644\u0627\u0633\u0645 \u0628\u0627\u0644\u0643\u0627\u0645\u0644 ", "name": "userName", "isLabel": true })}`} ${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "email", "place": "\u0627\u062F\u062E\u0644  \u0627\u0644\u0628\u0631\u064A\u062F \u0627\u0644\u0627\u0644\u0643\u062A\u0631\u0648\u0646\u064A", "title": " \u0627\u0644\u0628\u0631\u064A\u062F \u0627\u0644\u0627\u0644\u0643\u062A\u0631\u0648\u0646\u064A ", "name": "userEmail", "isLabel": true })} ${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "password", "place": "\u0627\u062F\u062E\u0644   \u0643\u0644\u0645\u0629 \u0627\u0644\u0645\u0631\u0648\u0631", "title": " \u0643\u0644\u0645\u0629 \u0627\u0644\u0645\u0631\u0648\u0631 ", "name": "userPassword", "isLabel": true })} ${isLogin && // <p>اذا كان لديك حساب بالفعل؟ </p>
  renderTemplate`<p class="py-6">ليس لدي حساب ؟ <a href="signIn.html" class="fw-700">انشاء حساب</a></p>
            <div class="mx-auto d-flex items-center justify-center"> ${renderComponent($$result, "Button", $$Button, { "type": "submit", "aria": "login in", "ClassName": "btn-base round-4 px-12 py-5 mt-10 mb-6" }, { "default": ($$result2) => renderTemplate`تسجيل` })} </div>`} ${!isLogin && // 
  renderTemplate`<p class="py-6"> اذا كان لديك حساب بالفعل؟ <a href="LoginIn.html" class="fw-700"> تسجيل </a></p>
            <div class="mx-auto d-flex items-center justify-center"> ${renderComponent($$result, "Button", $$Button, { "type": "submit", "aria": "login in", "ClassName": "btn-base round-4 px-12 py-5 mt-10 mb-6" }, { "default": ($$result2) => renderTemplate`انشاء حساب` })} </div>`} </form> </div> </section>`;
}, "D:/project/version/2/Astro/scooter/src/components/Auth/Auth.astro", void 0);

const $$Astro$h = createAstro();
const $$LoginIn = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$h, $$props, $$slots);
  Astro2.self = $$LoginIn;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Scooter | \u062A\u0633\u062C\u064A\u0644 \u062F\u062E\u0648\u0644 ", "des": "\u062A\u0648\u0641\u0631 \u062E\u062F\u0645\u0627\u062A \u062A\u0623\u062C\u064A\u0631 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0641\u064A \u0627\u0644\u0639\u0627\u0644\u0645 \u0627\u0644\u0639\u0631\u0628\u064A \u062E\u064A\u0627\u0631\u0627\u062A \u0646\u0642\u0644 \u0645\u0631\u064A\u062D\u0629 \u0648\u0635\u062F\u064A\u0642\u0629 \u0644\u0644\u0628\u064A\u0626\u0629 \u0644\u0644\u062A\u0646\u0642\u0644 \u0641\u064A \u0627\u0644\u0645\u0646\u0627\u0637\u0642 \u0627\u0644\u062D\u0636\u0631\u064A\u0629. \u0648\u064A\u0645\u0643\u0646 \u0644\u0644\u0645\u0633\u062A\u062E\u062F\u0645\u064A\u0646 \u0628\u0633\u0647\u0648\u0644\u0629 \u062A\u062D\u062F\u064A\u062F \u0645\u0648\u0642\u0639 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0627\u0644\u0643\u0647\u0631\u0628\u0627\u0626\u064A \u0648\u0641\u062A\u062D\u0647 \u0628\u0627\u0633\u062A\u062E\u062F\u0627\u0645 \u062A\u0637\u0628\u064A\u0642\u0627\u062A \u0627\u0644\u0647\u0648\u0627\u062A\u0641 \u0627\u0644\u0630\u0643\u064A\u0629\u060C \u0645\u0645\u0627 \u064A\u0639\u0632\u0632 \u0627\u0644\u062A\u0646\u0642\u0644 \u0627\u0644\u0645\u0633\u062A\u062F\u0627\u0645 \u0648\u064A\u0642\u0644\u0644 \u0627\u0644\u0627\u0632\u062F\u062D\u0627\u0645 \u0627\u0644\u0645\u0631\u0648\u0631\u064A. \u0627\u0633\u062A\u0643\u0634\u0641 \u0627\u0644\u0627\u0633\u062A\u0643\u0634\u0627\u0641 \u0627\u0644\u062D\u0636\u0631\u064A \u0627\u0644\u062E\u0627\u0644\u064A \u0645\u0646 \u0627\u0644\u0645\u062A\u0627\u0639\u0628 \u0645\u0639 \u062A\u0623\u062C\u064A\u0631 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0641\u064A \u0645\u062F\u0646 \u0627\u0644\u0639\u0627\u0644\u0645 \u0627\u0644\u0639\u0631\u0628\u064A." }, { "default": ($$result2) => renderTemplate` ${renderComponent($$result2, "Breadcrumb", $$Breadcrumb, { "linkPage": " \u062A\u0633\u062C\u064A\u0644 \u062F\u062E\u0648\u0644 ", "defPage": "\u0627\u0644\u0631\u0626\u064A\u0633\u064A\u0629", "path": "/" })} ${renderComponent($$result2, "Auth", $$Auth, { "isLogin": true })} ` })}`;
}, "D:/project/version/2/Astro/scooter/src/pages/LoginIn.astro", void 0);

const $$file$5 = "D:/project/version/2/Astro/scooter/src/pages/LoginIn.astro";
const $$url$5 = "/LoginIn.html";

const LoginIn = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$LoginIn,
  file: $$file$5,
  url: $$url$5
}, Symbol.toStringTag, { value: 'Module' }));

const $$Astro$g = createAstro();
const $$Book = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$g, $$props, $$slots);
  Astro2.self = $$Book;
  const { isBook } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<section class="book"> <div class="container"> <div class="btnFilters d-flex items-center justify-center pb-14"> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "now", "ClassName": "btn-filter fw-700 round-4 px-8 py-3 active", "id": "Now" }, { "default": ($$result2) => renderTemplate`
حجوزاتي الحالية
` })} ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "now", "ClassName": "btn-filter mr-5 fw-700 round-4 px-8 py-3", "id": "prev" }, { "default": ($$result2) => renderTemplate`
حجوزاتي السابقة
` })} </div> ${renderComponent($$result, "MainHeadingDes", $$MainHeadingDes, { "title": `${isBook ? "\u062D\u062C\u0648\u0632\u0627\u062A\u064A \u0627\u0644\u062D\u0627\u0644\u064A\u0629" : "\u062D\u062C\u0648\u0632\u0627\u062A\u064A \u0627\u0644\u0633\u0627\u0628\u0642\u0629"}`, "sub": "", "isSub": false, "position": "items-center" })} ${renderTemplate`<table> <thead> <tr> <td>الاسم</td> <td>الموديل</td> <td>السعر</td> <td>اللون</td> <td>الحالة</td> <td>العمليات</td> </tr> </thead> ${isBook && renderTemplate`<tbody${addAttribute(`${isBook ? "now  active" : "prev"}`, "class")}> <tr> <td>Minar Maxi </td> <td>2023</td> <td>50ر.س</td> <td>اخضر</td> <td>متاح</td> <td> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "sure btn", "ClassName": "btn-base px-8 py-3 round-4" }, { "default": ($$result2) => renderTemplate`
تاكيد
` })} </td> </tr> </tbody>`} <tbody${addAttribute(`prev`, "class")}> <tr> <td>Minar Maxi </td> <td>2023</td> <td>50ر.س</td> <td>اخضر</td> <td>متاح</td> <td> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "sure btn", "ClassName": "btn-base px-8 py-3 round-4" }, { "default": ($$result2) => renderTemplate`
تم القبول
` })} ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "sure btn", "ClassName": "btn-base px-8 py-3 round-4" }, { "default": ($$result2) => renderTemplate`
قيمنا
` })} </td> </tr> </tbody> </table>`} </div> </section>`;
}, "D:/project/version/2/Astro/scooter/src/components/book/Book.astro", void 0);

const $$Astro$f = createAstro();
const $$MyBook = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$f, $$props, $$slots);
  Astro2.self = $$MyBook;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Scooter | \u062D\u062C\u0648\u0632\u0627\u062A\u064A ", "des": "\u062A\u0648\u0641\u0631 \u062E\u062F\u0645\u0627\u062A \u062A\u0623\u062C\u064A\u0631 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0641\u064A \u0627\u0644\u0639\u0627\u0644\u0645 \u0627\u0644\u0639\u0631\u0628\u064A \u062E\u064A\u0627\u0631\u0627\u062A \u0646\u0642\u0644 \u0645\u0631\u064A\u062D\u0629 \u0648\u0635\u062F\u064A\u0642\u0629 \u0644\u0644\u0628\u064A\u0626\u0629 \u0644\u0644\u062A\u0646\u0642\u0644 \u0641\u064A \u0627\u0644\u0645\u0646\u0627\u0637\u0642 \u0627\u0644\u062D\u0636\u0631\u064A\u0629. \u0648\u064A\u0645\u0643\u0646 \u0644\u0644\u0645\u0633\u062A\u062E\u062F\u0645\u064A\u0646 \u0628\u0633\u0647\u0648\u0644\u0629 \u062A\u062D\u062F\u064A\u062F \u0645\u0648\u0642\u0639 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0627\u0644\u0643\u0647\u0631\u0628\u0627\u0626\u064A \u0648\u0641\u062A\u062D\u0647 \u0628\u0627\u0633\u062A\u062E\u062F\u0627\u0645 \u062A\u0637\u0628\u064A\u0642\u0627\u062A \u0627\u0644\u0647\u0648\u0627\u062A\u0641 \u0627\u0644\u0630\u0643\u064A\u0629\u060C \u0645\u0645\u0627 \u064A\u0639\u0632\u0632 \u0627\u0644\u062A\u0646\u0642\u0644 \u0627\u0644\u0645\u0633\u062A\u062F\u0627\u0645 \u0648\u064A\u0642\u0644\u0644 \u0627\u0644\u0627\u0632\u062F\u062D\u0627\u0645 \u0627\u0644\u0645\u0631\u0648\u0631\u064A. \u0627\u0633\u062A\u0643\u0634\u0641 \u0627\u0644\u0627\u0633\u062A\u0643\u0634\u0627\u0641 \u0627\u0644\u062D\u0636\u0631\u064A \u0627\u0644\u062E\u0627\u0644\u064A \u0645\u0646 \u0627\u0644\u0645\u062A\u0627\u0639\u0628 \u0645\u0639 \u062A\u0623\u062C\u064A\u0631 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0641\u064A \u0645\u062F\u0646 \u0627\u0644\u0639\u0627\u0644\u0645 \u0627\u0644\u0639\u0631\u0628\u064A." }, { "default": ($$result2) => renderTemplate` ${renderComponent($$result2, "Breadcrumb", $$Breadcrumb, { "linkPage": " \u062D\u062C\u0648\u0632\u0627\u062A\u064A ", "defPage": "\u0627\u0644\u0631\u0626\u064A\u0633\u064A\u0629", "path": "/" })} ${renderComponent($$result2, "Book", $$Book, { "isBook": true })} ` })}`;
}, "D:/project/version/2/Astro/scooter/src/pages/MyBook.astro", void 0);

const $$file$4 = "D:/project/version/2/Astro/scooter/src/pages/MyBook.astro";
const $$url$4 = "/MyBook.html";

const MyBook = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$MyBook,
  file: $$file$4,
  url: $$url$4
}, Symbol.toStringTag, { value: 'Module' }));

const $$Astro$e = createAstro();
const $$Card = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$e, $$props, $$slots);
  Astro2.self = $$Card;
  const { title, des, price, color, src, model, isStatus } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<div class="card round-6 mb-10"> <div class="imgContainer relative"> ${renderComponent($$result, "Image", $$Image, { "src": src, "alt": `card image scooter `, "quality": 70, "format": "webp", "class:list": `img-cover` })} <p class="model fs-14 px-5 py-3 round-4">${model}</p> <p${addAttribute(`status fs-14 px-5 py-3 round-4 ${isStatus ? "available" : "notAvailable"} `, "class")}> ${isStatus ? "\u0645\u062A\u0627\u062D" : "\u063A\u064A\u0631 \u0645\u062A\u0627\u062D"} </p> </div> <!-- card body --> <div class="cardBody round-6"> <!-- rate --> <div class="rate d-flex items-center py-5"> ${renderComponent($$result, "Icon", $$Icon, { "name": `rate` })} ${renderComponent($$result, "Icon", $$Icon, { "name": `rate` })} ${renderComponent($$result, "Icon", $$Icon, { "name": `rate` })} ${renderComponent($$result, "Icon", $$Icon, { "name": `rate` })} ${renderComponent($$result, "Icon", $$Icon, { "name": `rate` })} </div> <!-- title --> <h3 class="fs-24 fw-700">${title}</h3> <!-- price --> <p class="fs-28 fw-900 price"> ${price}<span class="fs-16 fw-700">ر.س</span><span class="fs-16 fw-700">/ساعة</span> </p> <!-- line --> <hr class="my-6"> <!-- des --> <p class="des fw-700 line-norma">${des}</p> <!-- color --> <ul class="d-flex items-center my-6"> <li class="color fw-700 fs-18">اللون:</li> <li class="isColor fw-700">${color}</li> </ul> <!-- buttons --> <div class="card-btn py-5 d-flex items-center justify-center"> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "\u0627\u062D\u062C\u0632 \u0627\u0644\u0627\u0646", "ClassName": "btn-base round-4" }, { "default": ($$result2) => renderTemplate` <a href="Book.html" class="fs-16 fw-700 px-14 py-4">احجز الان</a> ` })} ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "\u0627\u062D\u062C\u0632 \u0627\u0644\u0627\u0646", "ClassName": "btn-base round-4" }, { "default": ($$result2) => renderTemplate` <a href="productDetails.html" class="fs-16 fw-700 px-14 py-4">
التفاصيل
</a> ` })} </div> </div> </div>`;
}, "D:/project/version/2/Astro/scooter/src/components/Card/Card.astro", void 0);

const $$Astro$d = createAstro();
const $$FilterModel = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$d, $$props, $$slots);
  Astro2.self = $$FilterModel;
  const { isHead, isBook } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<div class="modelForm mx-auto round-6 relative"> ${isHead && renderTemplate`<div class="headModel "> <p class="title fw-700 fs-18">ابحث عن الاسكوتر</p> </div>`} <form action="/" class=""> ${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "date", "title": "\u062A\u0627\u0631\u064A\u062E \u0627\u0644\u062D\u062C\u0632", "name": "dateOFDay", "place": "d-m-y", "value": "2024-04-15" })} ${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "time", "title": " \u0648\u0642\u062A \u0628\u062F\u0627\u064A\u0629 \u0627\u0644\u062D\u062C\u0632", "name": "startHouer", "place": "d-m-y" })} ${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "time", "title": " \u0648\u0642\u062A \u0646\u0647\u0627\u064A\u0629 \u0627\u0644\u062D\u062C\u0632", "name": "endHouer", "place": "d-m-y" })} ${isBook && renderTemplate`${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "text", "title": "\u0639\u062F\u062F \u0627\u0644\u0633\u0627\u0639\u0627\u062A", "name": "Houer", "place": "\u0627\u062F\u062E\u0644 \u0639\u062F\u062F \u0633\u0627\u0639\u0627\u062A \u0627\u0644\u062D\u062C\u0632", "value": "1" })}
        ${renderComponent($$result, "FormGroup", $$FormGroup, { "type": "text", "title": "\u0627\u0644\u062A\u0643\u0644\u0641\u0629 \u0641\u064A \u0627\u0644\u0633\u0627\u0639\u0629", "name": "cost", "place": "\u062A\u0643\u0644\u0641\u0629 \u0627\u0644\u062D\u062C\u0632 \u0641\u064A \u0627\u0644\u0633\u0627\u0639\u0629", "value": "50", "isDisabled": true })}`} <div class="relative d-flex items-center justify-center"> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "\u0627\u062D\u062C\u0632 \u0627\u0644\u0627\u0646", "ClassName": "btn-base px-14 py-5 mt-8 fw-700 round-4" }, { "default": ($$result2) => renderTemplate`${isHead ? "\u0628\u062D\u062B" : isBook ? "\u062D\u062C\u0632" : " \u0627\u062D\u062C\u0632 \u0627\u0644\u0627\u0633\u0643\u0648\u062A\u0631 \u0627\u0644\u0627\u0646"} ` })} </div> ${isBook && renderTemplate`${renderSlot($$result, $$slots["default"])}`} </form> </div>`;
}, "D:/project/version/2/Astro/scooter/src/components/Hero/FilterModel.astro", void 0);

const $$Astro$c = createAstro();
const $$Pagination = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$c, $$props, $$slots);
  Astro2.self = $$Pagination;
  return renderTemplate`${maybeRenderHead()}<nav class="pagination mx-auto"> <ul class="d-flex items-center justify-around"> <li><a href="#!">السابق</a></li> <li><a href="#!" class="active">1</a></li> <li><a href="#!">2</a></li> <li><a href="#!">3</a></li> <li><a href="#!">التالي</a></li> </ul> </nav>`;
}, "D:/project/version/2/Astro/scooter/src/components/ui/Pagination.astro", void 0);

const $$Astro$b = createAstro();
const $$ProPageSection = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$b, $$props, $$slots);
  Astro2.self = $$ProPageSection;
  return renderTemplate`${maybeRenderHead()}<section class="proPageSection"> <div class="container"> <div class="row items-start gap-row-1 "> <!-- right  pro--> <div class="col-8-lg col-7-md col-12-sm"> <div class="rightTop d-flex items-center justify-between mb-10"> <select name="Sort " id="Sort " class="round-6 px-5"> <option value="SortBy ">ترتيب حسب</option> <option value="NewestFirst">الأحدث أولاً</option> <option value="OldestFirst">الأقدم أولا</option> <option value="A_z">أ-ي</option> <option value="Z_a">ي-أ</option> </select> <p class="searchResult fw-700 fs-14 ml-7">تم العثور على 4 نتائج (عرض 1-4)</p> </div> <div class="row gap-row-1"> ${CardDate.slice(0, 4).map((card) => renderTemplate`<div class="col-6-lg col-6-md col-12-sm"> ${renderComponent($$result, "Card", $$Card, { "title": card.title, "des": card.des, "price": card.price, "color": card.color, "model": card.model, "src": card.img, "isStatus": card.available })} </div>`)} </div> ${renderComponent($$result, "Pagination", $$Pagination, {})} </div> <!-- left aside --> <div class="col-4-lg col-5-md col-12-sm"> <aside> ${renderComponent($$result, "FilterModel", $$FilterModel, { "isHead": true, "isBook": false })} </aside> </div> </div> </div> </section>`;
}, "D:/project/version/2/Astro/scooter/src/components/products/proPageSection.astro", void 0);

const $$Astro$a = createAstro();
const $$Product = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$a, $$props, $$slots);
  Astro2.self = $$Product;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Scooter | \u0645\u0646\u062A\u062C\u0627\u062A\u0646\u0627 ", "des": "\u062A\u0648\u0641\u0631 \u062E\u062F\u0645\u0627\u062A \u062A\u0623\u062C\u064A\u0631 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0641\u064A \u0627\u0644\u0639\u0627\u0644\u0645 \u0627\u0644\u0639\u0631\u0628\u064A \u062E\u064A\u0627\u0631\u0627\u062A \u0646\u0642\u0644 \u0645\u0631\u064A\u062D\u0629 \u0648\u0635\u062F\u064A\u0642\u0629 \u0644\u0644\u0628\u064A\u0626\u0629 \u0644\u0644\u062A\u0646\u0642\u0644 \u0641\u064A \u0627\u0644\u0645\u0646\u0627\u0637\u0642 \u0627\u0644\u062D\u0636\u0631\u064A\u0629. \u0648\u064A\u0645\u0643\u0646 \u0644\u0644\u0645\u0633\u062A\u062E\u062F\u0645\u064A\u0646 \u0628\u0633\u0647\u0648\u0644\u0629 \u062A\u062D\u062F\u064A\u062F \u0645\u0648\u0642\u0639 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0627\u0644\u0643\u0647\u0631\u0628\u0627\u0626\u064A \u0648\u0641\u062A\u062D\u0647 \u0628\u0627\u0633\u062A\u062E\u062F\u0627\u0645 \u062A\u0637\u0628\u064A\u0642\u0627\u062A \u0627\u0644\u0647\u0648\u0627\u062A\u0641 \u0627\u0644\u0630\u0643\u064A\u0629\u060C \u0645\u0645\u0627 \u064A\u0639\u0632\u0632 \u0627\u0644\u062A\u0646\u0642\u0644 \u0627\u0644\u0645\u0633\u062A\u062F\u0627\u0645 \u0648\u064A\u0642\u0644\u0644 \u0627\u0644\u0627\u0632\u062F\u062D\u0627\u0645 \u0627\u0644\u0645\u0631\u0648\u0631\u064A. \u0627\u0633\u062A\u0643\u0634\u0641 \u0627\u0644\u0627\u0633\u062A\u0643\u0634\u0627\u0641 \u0627\u0644\u062D\u0636\u0631\u064A \u0627\u0644\u062E\u0627\u0644\u064A \u0645\u0646 \u0627\u0644\u0645\u062A\u0627\u0639\u0628 \u0645\u0639 \u062A\u0623\u062C\u064A\u0631 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0641\u064A \u0645\u062F\u0646 \u0627\u0644\u0639\u0627\u0644\u0645 \u0627\u0644\u0639\u0631\u0628\u064A." }, { "default": ($$result2) => renderTemplate` ${renderComponent($$result2, "Breadcrumb", $$Breadcrumb, { "linkPage": "\u0645\u0646\u062A\u062C\u0627\u062A\u0646\u0627 ", "defPage": "\u0627\u0644\u0631\u0626\u064A\u0633\u064A\u0629", "path": "/" })} ${renderComponent($$result2, "ProPageSection", $$ProPageSection, {})} ` })}`;
}, "D:/project/version/2/Astro/scooter/src/pages/product.astro", void 0);

const $$file$3 = "D:/project/version/2/Astro/scooter/src/pages/product.astro";
const $$url$3 = "/product.html";

const product = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$Product,
  file: $$file$3,
  url: $$url$3
}, Symbol.toStringTag, { value: 'Module' }));

const $$Astro$9 = createAstro();
const $$Gallery = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$9, $$props, $$slots);
  Astro2.self = $$Gallery;
  return renderTemplate`${maybeRenderHead()}<div class="gallery"> <div class="main-img mb-6"> ${renderComponent($$result, "Image", $$Image, { "src": img, "alt": `pro main image`, "format": "webp", "quality": 50, "class": `round-6` })} </div> <div class="sub-img d-flex items-center gap-5"> <div class="imgContainer"> ${renderComponent($$result, "Image", $$Image, { "src": img, "alt": `pro main image`, "format": "webp", "quality": 50, "class": `round-4 active` })} </div> <div class="imgContainer"> ${renderComponent($$result, "Image", $$Image, { "src": img2, "alt": `pro main image`, "format": "webp", "quality": 50, "class": `round-4` })} </div> <div class="imgContainer"> ${renderComponent($$result, "Image", $$Image, { "src": img, "alt": `pro main image`, "format": "webp", "quality": 50, "class": `round-4` })} </div> <div class="imgContainer"> ${renderComponent($$result, "Image", $$Image, { "src": img2, "alt": `pro main image`, "format": "webp", "quality": 50, "class": `round-4` })} </div> </div> </div>`;
}, "D:/project/version/2/Astro/scooter/src/components/products/Gallery.astro", void 0);

const $$Astro$8 = createAstro();
const $$AddReview = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$8, $$props, $$slots);
  Astro2.self = $$AddReview;
  return renderTemplate`${maybeRenderHead()}<div class="addRateModel d-flex items-center justify-center"> <form action="" class="round-6 relative"> <p class="text-center fs-24 fw-900 pb-8">اعطنا تقيمك</p> <div class="rate d-flex items-center justify-around mb-8"> <p class="pl-8 fw-700 fs-18">تقيمك</p> <div class="star d-flex"> ${renderComponent($$result, "Icon", $$Icon, { "name": `rate`, "class": "starRating", "data-value": "1" })} ${renderComponent($$result, "Icon", $$Icon, { "name": `rate`, "class": "starRating", "data-value": "2" })} ${renderComponent($$result, "Icon", $$Icon, { "name": `rate`, "class": "starRating", "data-value": "3" })} ${renderComponent($$result, "Icon", $$Icon, { "name": `rate`, "class": "starRating", "data-value": "4" })} ${renderComponent($$result, "Icon", $$Icon, { "name": `rate`, "class": "starRating", "data-value": "5" })} </div> </div> <textarea name="addComment" id="addComment" class="pr-5 pt-5 round-4" placeholder="اضف تعليقك"></textarea> <div class="d-flex items-center justify-center my-8"> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "addComment", "ClassName": "btn-base px-12 py-5 round-6 fw-700" }, { "default": ($$result2) => renderTemplate`حفظ
` })} </div> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "close model", "ClassName": "btn-close px-5 py-4 round-6", "id": "closeRateModel" }, { "default": ($$result2) => renderTemplate` ${renderComponent($$result2, "Icon", $$Icon, { "name": "close" })} ` })} </form> </div>`;
}, "D:/project/version/2/Astro/scooter/src/components/products/AddReview.astro", void 0);

const $$Astro$7 = createAstro();
const $$Review = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$7, $$props, $$slots);
  Astro2.self = $$Review;
  return renderTemplate`${maybeRenderHead()}<div class="review mt-10"> <p class="fs-24 fw-900 pb-8">1 مراجعة</p> <div class="userReview py-6 px-10 round-4 mb-6"> <div class="userRate d-flex items-center justify-between"> <div class="userName fw-700 fs-18 pb-5">احمد التطاوي</div> <div class="star d-flex"> ${renderComponent($$result, "Icon", $$Icon, { "name": `rate` })} ${renderComponent($$result, "Icon", $$Icon, { "name": `rate` })} ${renderComponent($$result, "Icon", $$Icon, { "name": `rate` })} ${renderComponent($$result, "Icon", $$Icon, { "name": `rate` })} ${renderComponent($$result, "Icon", $$Icon, { "name": `rate` })} </div> </div> <p class="userComment fw-700">أفضل الدراجات البخارية الكهربائية</p> </div> <div class="d-flex items-center justify-center"> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "addComment", "ClassName": "btn-base px-12 py-5 round-6 fw-700", "id": "addRate" }, { "default": ($$result2) => renderTemplate`اضف تقيمك` })} ${renderComponent($$result, "AddReview", $$AddReview, {})} </div> </div>`;
}, "D:/project/version/2/Astro/scooter/src/components/products/Review.astro", void 0);

const $$Astro$6 = createAstro();
const $$ProDetails = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$6, $$props, $$slots);
  Astro2.self = $$ProDetails;
  return renderTemplate`${maybeRenderHead()}<section class="ProDetails"> <div class="container"> <div class="row gap-row-1 items-start"> <!-- left side gallery --> <div class="col-5-lg col-6-md col-12-sm"> ${renderComponent($$result, "Gallery", $$Gallery, {})} ${renderComponent($$result, "Review", $$Review, {})} </div> <!-- right side --> <div class="col-7-lg col-6-md col-12-sm"> <div class="details"> <!-- rate --> <div class="rate d-flex item-center mb-6"> <div class="star d-flex"> ${renderComponent($$result, "Icon", $$Icon, { "name": `rate` })} ${renderComponent($$result, "Icon", $$Icon, { "name": `rate` })} ${renderComponent($$result, "Icon", $$Icon, { "name": `rate` })} ${renderComponent($$result, "Icon", $$Icon, { "name": `rate` })} ${renderComponent($$result, "Icon", $$Icon, { "name": `rate` })} </div> <div class="numReview items-center pr-5 fs-18 fw-700">1 مراجعة</div> </div> <!-- title --> <h2 class="fw-900 fs-30">Metric ES150 سكوتر</h2> <!-- price --> <p class="fs-28 fw-900 price mb-6">
50<span class="fs-16 fw-700">ر.س</span><span class="fs-16 fw-700">/ساعة</span> </p> <hr class="mb-6"> <!-- full des --> <p class="des py-6 fs-18 fw-700 line-big">
يتميز سكوتر Minar Maxi بتصميم أنيق وعصري، يهدف إلى توفير الجمال
            والأداء الوظيفي. يشتمل تركيبها على مواد خفيفة الوزن من أجل خفة
            الحركة والقدرة على المناورة مع الحفاظ على المتانة والاستقرار
</p> <hr class="my-6"> <!-- color --> <ul class="d-flex items-center py-6"> <li class="color fw-700 fs-18">اللون:</li> <li class="isColor fw-700 ml-14">اسود</li> <li class="color fw-700 fs-18">الحالة:</li> <li class="isColor fw-700 ml-14">متاح</li> <li class="color fw-700 fs-18">موديل:</li> <li class="isColor fw-700">2023</li> </ul> <hr class="my-6"> <!-- Rental Policy --> <ul class="RentalPolicy py-6"> <p class="fs-24 fw-700 pb-6">سياسة الإيجار</p> <li class="fw-700 pb-6">ادفع 15% فقط الآن والباقي في الوجهة.</li> <li class="fw-700 pb-6">
قم بالإلغاء حتى 48 ساعة قبل الاستلام واسترد أموالك بالكامل
</li> <li class="fw-700 pb-6">
هذه السيارة تتطلب رخصة فئة A1 أو ما يعادلها.
</li> <li class="fw-700 pb-6">
يجب أن يكون عمرك 18 عامًا على الأقل لتتمكن من استئجارها مع خبرة
              قيادة مدتها 12 شهرًا
</li> <li class="fw-700 pb-6">
يلزم تقديم وديعة تأمين قابلة للاسترداد (بطاقة خصم بقيمة 24 ر.س)
              عند الاستلام.
</li> </ul> </div> </div> <div class="d-flex items-center justify-center mx-auto pt-14"> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "BookNow", "ClassName": "btn-base px-12 py-5 round-6 fw-700", "id": "BookNow" }, { "default": ($$result2) => renderTemplate` احجز الان ` })} <div class="BookNowModel"> ${renderComponent($$result, "FilterModel", $$FilterModel, { "isBook": true, "isHead": false }, { "default": ($$result2) => renderTemplate` ${renderComponent($$result2, "Button", $$Button, { "type": "button", "aria": "close model", "ClassName": "btn-close px-5 py-4 round-6", "id": "closeBookModel" }, { "default": ($$result3) => renderTemplate` ${renderComponent($$result3, "Icon", $$Icon, { "name": "close" })} ` })} ` })} </div> </div> </div> </div> </section>`;
}, "D:/project/version/2/Astro/scooter/src/components/products/proDetails.astro", void 0);

const $$Astro$5 = createAstro();
const $$ProductDetails = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$5, $$props, $$slots);
  Astro2.self = $$ProductDetails;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Scooter | \u062A\u0641\u0627\u0635\u064A\u0644 \u0627\u0644\u0645\u0646\u062A\u062C", "des": "\u062A\u0648\u0641\u0631 \u062E\u062F\u0645\u0627\u062A \u062A\u0623\u062C\u064A\u0631 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0641\u064A \u0627\u0644\u0639\u0627\u0644\u0645 \u0627\u0644\u0639\u0631\u0628\u064A \u062E\u064A\u0627\u0631\u0627\u062A \u0646\u0642\u0644 \u0645\u0631\u064A\u062D\u0629 \u0648\u0635\u062F\u064A\u0642\u0629 \u0644\u0644\u0628\u064A\u0626\u0629 \u0644\u0644\u062A\u0646\u0642\u0644 \u0641\u064A \u0627\u0644\u0645\u0646\u0627\u0637\u0642 \u0627\u0644\u062D\u0636\u0631\u064A\u0629. \u0648\u064A\u0645\u0643\u0646 \u0644\u0644\u0645\u0633\u062A\u062E\u062F\u0645\u064A\u0646 \u0628\u0633\u0647\u0648\u0644\u0629 \u062A\u062D\u062F\u064A\u062F \u0645\u0648\u0642\u0639 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0627\u0644\u0643\u0647\u0631\u0628\u0627\u0626\u064A \u0648\u0641\u062A\u062D\u0647 \u0628\u0627\u0633\u062A\u062E\u062F\u0627\u0645 \u062A\u0637\u0628\u064A\u0642\u0627\u062A \u0627\u0644\u0647\u0648\u0627\u062A\u0641 \u0627\u0644\u0630\u0643\u064A\u0629\u060C \u0645\u0645\u0627 \u064A\u0639\u0632\u0632 \u0627\u0644\u062A\u0646\u0642\u0644 \u0627\u0644\u0645\u0633\u062A\u062F\u0627\u0645 \u0648\u064A\u0642\u0644\u0644 \u0627\u0644\u0627\u0632\u062F\u062D\u0627\u0645 \u0627\u0644\u0645\u0631\u0648\u0631\u064A. \u0627\u0633\u062A\u0643\u0634\u0641 \u0627\u0644\u0627\u0633\u062A\u0643\u0634\u0627\u0641 \u0627\u0644\u062D\u0636\u0631\u064A \u0627\u0644\u062E\u0627\u0644\u064A \u0645\u0646 \u0627\u0644\u0645\u062A\u0627\u0639\u0628 \u0645\u0639 \u062A\u0623\u062C\u064A\u0631 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0641\u064A \u0645\u062F\u0646 \u0627\u0644\u0639\u0627\u0644\u0645 \u0627\u0644\u0639\u0631\u0628\u064A." }, { "default": ($$result2) => renderTemplate` ${renderComponent($$result2, "Breadcrumb", $$Breadcrumb, { "linkPage": " \u062A\u0641\u0627\u0635\u064A\u0644 \u0627\u0644\u0645\u0646\u062A\u062C ", "defPage": "\u0627\u0644\u0631\u0626\u064A\u0633\u064A\u0629", "path": "/" })} ${renderComponent($$result2, "ProDetails", $$ProDetails, {})}  ` })}`;
}, "D:/project/version/2/Astro/scooter/src/pages/productDetails.astro", void 0);

const $$file$2 = "D:/project/version/2/Astro/scooter/src/pages/productDetails.astro";
const $$url$2 = "/productDetails.html";

const productDetails = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$ProductDetails,
  file: $$file$2,
  url: $$url$2
}, Symbol.toStringTag, { value: 'Module' }));

const $$Astro$4 = createAstro();
const $$SignIn = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$4, $$props, $$slots);
  Astro2.self = $$SignIn;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Scooter | \u0627\u0646\u0634\u0627\u0621 \u062D\u0633\u0627\u0628 ", "des": "\u062A\u0648\u0641\u0631 \u062E\u062F\u0645\u0627\u062A \u062A\u0623\u062C\u064A\u0631 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0641\u064A \u0627\u0644\u0639\u0627\u0644\u0645 \u0627\u0644\u0639\u0631\u0628\u064A \u062E\u064A\u0627\u0631\u0627\u062A \u0646\u0642\u0644 \u0645\u0631\u064A\u062D\u0629 \u0648\u0635\u062F\u064A\u0642\u0629 \u0644\u0644\u0628\u064A\u0626\u0629 \u0644\u0644\u062A\u0646\u0642\u0644 \u0641\u064A \u0627\u0644\u0645\u0646\u0627\u0637\u0642 \u0627\u0644\u062D\u0636\u0631\u064A\u0629. \u0648\u064A\u0645\u0643\u0646 \u0644\u0644\u0645\u0633\u062A\u062E\u062F\u0645\u064A\u0646 \u0628\u0633\u0647\u0648\u0644\u0629 \u062A\u062D\u062F\u064A\u062F \u0645\u0648\u0642\u0639 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0627\u0644\u0643\u0647\u0631\u0628\u0627\u0626\u064A \u0648\u0641\u062A\u062D\u0647 \u0628\u0627\u0633\u062A\u062E\u062F\u0627\u0645 \u062A\u0637\u0628\u064A\u0642\u0627\u062A \u0627\u0644\u0647\u0648\u0627\u062A\u0641 \u0627\u0644\u0630\u0643\u064A\u0629\u060C \u0645\u0645\u0627 \u064A\u0639\u0632\u0632 \u0627\u0644\u062A\u0646\u0642\u0644 \u0627\u0644\u0645\u0633\u062A\u062F\u0627\u0645 \u0648\u064A\u0642\u0644\u0644 \u0627\u0644\u0627\u0632\u062F\u062D\u0627\u0645 \u0627\u0644\u0645\u0631\u0648\u0631\u064A. \u0627\u0633\u062A\u0643\u0634\u0641 \u0627\u0644\u0627\u0633\u062A\u0643\u0634\u0627\u0641 \u0627\u0644\u062D\u0636\u0631\u064A \u0627\u0644\u062E\u0627\u0644\u064A \u0645\u0646 \u0627\u0644\u0645\u062A\u0627\u0639\u0628 \u0645\u0639 \u062A\u0623\u062C\u064A\u0631 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0641\u064A \u0645\u062F\u0646 \u0627\u0644\u0639\u0627\u0644\u0645 \u0627\u0644\u0639\u0631\u0628\u064A." }, { "default": ($$result2) => renderTemplate` ${renderComponent($$result2, "Breadcrumb", $$Breadcrumb, { "linkPage": "  \u0627\u0646\u0634\u0627\u0621 \u062D\u0633\u0627\u0628 ", "defPage": "\u0627\u0644\u0631\u0626\u064A\u0633\u064A\u0629", "path": "/" })} ${renderComponent($$result2, "Auth", $$Auth, { "isLogin": false })} ` })}`;
}, "D:/project/version/2/Astro/scooter/src/pages/signIn.astro", void 0);

const $$file$1 = "D:/project/version/2/Astro/scooter/src/pages/signIn.astro";
const $$url$1 = "/signIn.html";

const signIn = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$SignIn,
  file: $$file$1,
  url: $$url$1
}, Symbol.toStringTag, { value: 'Module' }));

const HeroImg = new Proxy({"src":"./assets/images/hero-D1I4HtEm.jpg","width":1920,"height":1280,"format":"jpg"}, {
						get(target, name, receiver) {
							if (name === 'clone') {
								return structuredClone(target);
							}
							if (name === 'fsPath') {
								return "D:/project/version/2/Astro/scooter/src/assets/images/hero.jpg";
							}
							if (target[name] !== undefined) globalThis.astroAsset.referencedImages.add("D:/project/version/2/Astro/scooter/src/assets/images/hero.jpg");
							return target[name];
						}
					});

const $$Astro$3 = createAstro();
const $$TextBox = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$3, $$props, $$slots);
  Astro2.self = $$TextBox;
  return renderTemplate`${maybeRenderHead()}<div class="boxText relative"> <h1 class="fs-r-60 fw-900 line-normal">بدأ رحلتك مع سكوتي</h1> <p class="fs-18 mt-5 line-relaxed">
استمتع بتجربة المدينة كما لم يحدث من قبل من خلال استئجار واحدة من دراجاتنا
    البخارية الأنيقة والصديقة للبيئة. سواء كنت تتنقل إلى العمل، أو تستكشف
    الجواهر المخفية، أو ببساطة تستمتع برحلة ممتعة، فإن دراجاتنا البخارية توفر
    وسيلة النقل المثالية لأي مناسبة.
</p> ${renderComponent($$result, "Button", $$Button, { "type": "button", "aria": "\u0627\u0646\u0636\u0645 \u0627\u0644\u064A\u0646\u0627", "ClassName": "btn-base mt-14  round-6 join-btn" }, { "default": ($$result2) => renderTemplate` <a href="LoginIn.html" class="px-14 py-6 fs-18 fw-700">انضم الينا</a> ` })} </div>`;
}, "D:/project/version/2/Astro/scooter/src/components/Hero/TextBox.astro", void 0);

const $$Astro$2 = createAstro();
const $$Hero = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$2, $$props, $$slots);
  Astro2.self = $$Hero;
  const { Client, Admin, job } = Astro2.props;
  return renderTemplate`${maybeRenderHead()}<section class="hero relative "> ${Client && renderTemplate`<div class="imgContainer"> ${renderComponent($$result, "Image", $$Image, { "src": HeroImg, "alt": `hero img bg`, "format": "webp", "quality": 50, "class": `img-cover` })} </div>
    <div class="container"> <div class="row items-center"> <div class="col-6-lg col-6-md col-12-sm"> ${renderComponent($$result, "TextHero", $$TextBox, {})} </div> <!-- right-FilterModel --> <div class="col-6-lg col-6-md col-12-sm"> ${renderComponent($$result, "FilterModel", $$FilterModel, { "isHead": false, "isBook": false })} </div> </div> <!-- left box text --> </div>`} </section>`;
}, "D:/project/version/2/Astro/scooter/src/components/Hero/Hero.astro", void 0);

const $$Astro$1 = createAstro();
const $$ProSection = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro$1, $$props, $$slots);
  Astro2.self = $$ProSection;
  return renderTemplate`${maybeRenderHead()}<section class="products"> ${renderComponent($$result, "MainHeadingDes", $$MainHeadingDes, { "sub": "\u0645\u0646\u062A\u062C\u0627\u062A\u0646\u0627", "isSub": true, "title": "\u0623\u0633\u0637\u0648\u0644 \u0627\u0644\u0625\u064A\u062C\u0627\u0631 \u0644\u062F\u064A\u0646\u0627", "position": "items-center" })} <div class="container"> <div class="row gap-row-1"> ${CardDate.slice(0, 6).map((card) => renderTemplate`<div class="col-4-lg col-6-md col-12-sm"> ${renderComponent($$result, "Card", $$Card, { "title": card.title, "src": card.img, "des": card.des, "price": card.price, "color": card.color, "model": card.model, "isStatus": card.available })} </div>`)} </div> </div> </section>`;
}, "D:/project/version/2/Astro/scooter/src/components/products/ProSection.astro", void 0);

const $$Astro = createAstro();
const $$Index = createComponent(async ($$result, $$props, $$slots) => {
  const Astro2 = $$result.createAstro($$Astro, $$props, $$slots);
  Astro2.self = $$Index;
  return renderTemplate`${renderComponent($$result, "Layout", $$Layout, { "title": "Scooter | \u0627\u0644\u0635\u0641\u062D\u0629 \u0627\u0644\u0631\u0626\u064A\u0633\u064A\u0629", "des": "\u062A\u0648\u0641\u0631 \u062E\u062F\u0645\u0627\u062A \u062A\u0623\u062C\u064A\u0631 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0641\u064A \u0627\u0644\u0639\u0627\u0644\u0645 \u0627\u0644\u0639\u0631\u0628\u064A \u062E\u064A\u0627\u0631\u0627\u062A \u0646\u0642\u0644 \u0645\u0631\u064A\u062D\u0629 \u0648\u0635\u062F\u064A\u0642\u0629 \u0644\u0644\u0628\u064A\u0626\u0629 \u0644\u0644\u062A\u0646\u0642\u0644 \u0641\u064A \u0627\u0644\u0645\u0646\u0627\u0637\u0642 \u0627\u0644\u062D\u0636\u0631\u064A\u0629. \u0648\u064A\u0645\u0643\u0646 \u0644\u0644\u0645\u0633\u062A\u062E\u062F\u0645\u064A\u0646 \u0628\u0633\u0647\u0648\u0644\u0629 \u062A\u062D\u062F\u064A\u062F \u0645\u0648\u0642\u0639 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0627\u0644\u0643\u0647\u0631\u0628\u0627\u0626\u064A \u0648\u0641\u062A\u062D\u0647 \u0628\u0627\u0633\u062A\u062E\u062F\u0627\u0645 \u062A\u0637\u0628\u064A\u0642\u0627\u062A \u0627\u0644\u0647\u0648\u0627\u062A\u0641 \u0627\u0644\u0630\u0643\u064A\u0629\u060C \u0645\u0645\u0627 \u064A\u0639\u0632\u0632 \u0627\u0644\u062A\u0646\u0642\u0644 \u0627\u0644\u0645\u0633\u062A\u062F\u0627\u0645 \u0648\u064A\u0642\u0644\u0644 \u0627\u0644\u0627\u0632\u062F\u062D\u0627\u0645 \u0627\u0644\u0645\u0631\u0648\u0631\u064A. \u0627\u0633\u062A\u0643\u0634\u0641 \u0627\u0644\u0627\u0633\u062A\u0643\u0634\u0627\u0641 \u0627\u0644\u062D\u0636\u0631\u064A \u0627\u0644\u062E\u0627\u0644\u064A \u0645\u0646 \u0627\u0644\u0645\u062A\u0627\u0639\u0628 \u0645\u0639 \u062A\u0623\u062C\u064A\u0631 \u0627\u0644\u0633\u0643\u0648\u062A\u0631 \u0641\u064A \u0645\u062F\u0646 \u0627\u0644\u0639\u0627\u0644\u0645 \u0627\u0644\u0639\u0631\u0628\u064A." }, { "default": ($$result2) => renderTemplate` ${renderComponent($$result2, "Hero", $$Hero, { "Client": true, "Admin": false, "job": false })} ${renderComponent($$result2, "AboutSection", $$AboutSection, { "isAboutPage": true })} ${renderComponent($$result2, "ProSection", $$ProSection, {})} ` })}`;
}, "D:/project/version/2/Astro/scooter/src/pages/index.astro", void 0);

const $$file = "D:/project/version/2/Astro/scooter/src/pages/index.astro";
const $$url = "";

const index = /*#__PURE__*/Object.freeze(/*#__PURE__*/Object.defineProperty({
  __proto__: null,
  default: $$Index,
  file: $$file,
  url: $$url
}, Symbol.toStringTag, { value: 'Module' }));

export { AboutUs as A, ContactUs as C, LoginIn as L, MyBook as M, productDetails as a, index as i, product as p, signIn as s };
