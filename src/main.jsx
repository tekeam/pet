import React, { useMemo, useState } from 'react';
import { createRoot } from 'react-dom/client';
import { Search, Star, Heart, Bell, Home, PawPrint, Sparkles, User, ChevronLeft, ShieldCheck, Scale, Stethoscope } from 'lucide-react';
import './styles.css';

const brands = [
  { id: 'royal', name: 'رویال کنین', latin: 'Royal Canin', tier: 'سوپرپرمیوم', short: 'RC', country: 'فرانسه', desc: 'فرمول های تخصصی برای سن، نژاد و مشکلات سلامتی پت.' },
  { id: 'acana', name: 'آکانا', latin: 'Acana', tier: 'پرمیوم', short: 'AC', country: 'کانادا', desc: 'غذاهای پروتئینی با ترکیبات طبیعی برای پت های فعال.' },
  { id: 'hills', name: 'هیلز', latin: 'Hills', tier: 'درمانی', short: 'HL', country: 'آمریکا', desc: 'رژیم های دامپزشکی برای گوارش، کلیه و کنترل وزن.' },
  { id: 'whiskas', name: 'ویسکاس', latin: 'Whiskas', tier: 'اقتصادی', short: 'WK', country: 'تایلند', desc: 'غذای اقتصادی روزانه برای گربه های بالغ سالم.' },
  { id: 'proplan', name: 'پروپلن', latin: 'Pro Plan', tier: 'پرمیوم', short: 'PP', country: 'آمریکا', desc: 'فرمول های حرفه ای برای سلامت عمومی و نیازهای خاص.' },
  { id: 'josera', name: 'جوسرا', latin: 'Josera', tier: 'اقتصادی پلاس', short: 'JS', country: 'آلمان', desc: 'گزینه اقتصادی تر با کیفیت مناسب برای مصرف روزانه.' }
];

const products = [
  { id: 1, brandId: 'royal', brand: 'رویال کنین', name: 'گاسترواینتستینال', problem: 'گوارشی', price: '۱,۸۵۰,۰۰۰', rating: 4.8, color: '#7c3aed', reason: 'برای استفراغ، اسهال و معده حساس مناسب است.' },
  { id: 2, brandId: 'royal', brand: 'رویال کنین', name: 'رنال', problem: 'کلیوی', price: '۱,۹۲۰,۰۰۰', rating: 4.7, color: '#2563eb', reason: 'برای حمایت از کلیه و رژیم دامپزشکی.' },
  { id: 3, brandId: 'acana', brand: 'آکانا', name: 'ایندور انتری', problem: 'کنترل وزن', price: '۲,۲۰۰,۰۰۰', rating: 4.8, color: '#059669', reason: 'برای گربه های داخل خانه و کم تحرک.' },
  { id: 4, brandId: 'hills', brand: 'هیلز', name: 'دایجستیو کر', problem: 'گوارشی', price: '۱,۷۲۰,۰۰۰', rating: 4.7, color: '#ea580c', reason: 'برای هضم بهتر و روده حساس.' },
  { id: 5, brandId: 'whiskas', brand: 'ویسکاس', name: 'ادالت چیکن', problem: 'اقتصادی', price: '۴۹۰,۰۰۰', rating: 4.1, color: '#db2777', reason: 'گزینه ارزان تر برای مصرف روزانه.' },
  { id: 6, brandId: 'josera', brand: 'جوسرا', name: 'کولینس', problem: 'اقتصادی', price: '۸۹۰,۰۰۰', rating: 4.3, color: '#16a34a', reason: 'بالانس اقتصادی با کیفیت قابل قبول.' },
  { id: 7, brandId: 'proplan', brand: 'پروپلن', name: 'استریلایزد', problem: 'عقیم', price: '۱,۴۸۰,۰۰۰', rating: 4.5, color: '#0f766e', reason: 'برای کنترل وزن بعد از عقیم سازی.' }
];

const problems = ['همه', 'گوارشی', 'کلیوی', 'کنترل وزن', 'عقیم', 'اقتصادی'];

function ProductCard({ product }) {
  return <article className="product-card">
    <div className="bag" style={{ background: product.color }}><PawPrint size={26}/></div>
    <div><small>{product.brand}</small><h3>{product.name}</h3><p>{product.reason}</p><b>{product.price} تومان</b></div>
    <span className="rating"><Star size={14} fill="currentColor"/> {product.rating}</span>
  </article>;
}

function BrandCard({ brand }) {
  const count = products.filter(p => p.brandId === brand.id).length;
  return <article className="brand-row">
    <div className="brand-logo">{brand.short}</div>
    <div><h3>{brand.name}</h3><p>{brand.latin} | {brand.tier} | {brand.country}</p><span>{brand.desc}</span></div>
    <b>{count} غذا</b>
  </article>;
}

function HomeScreen({ setTab, problem, setProblem, list }) {
  return <>
    <header className="hero">
      <div className="hero-actions"><button><Heart size={19}/></button><button><Bell size={19}/></button></div>
      <p className="eyebrow">Pettt AI Food Finder</p>
      <h1>غذای مناسب پتتو پیدا کن</h1>
      <p>مرجع فارسی برندها، محصولات و پیشنهاد غذای حیوانات خانگی.</p>
      <button className="search" onClick={() => setTab('brands')}><Search size={19}/><span>جستجو در برندها و غذاها...</span></button>
    </header>
    <main className="content">
      <ProblemTabs selected={problem} setSelected={setProblem}/>
      <section className="section-head"><h2>برندهای محبوب</h2><button onClick={() => setTab('brands')}>مشاهده همه <ChevronLeft size={15}/></button></section>
      <section className="brand-grid">{brands.slice(0,4).map(b => <button className="brand" key={b.id} onClick={() => setTab('brands')}><div>{b.short}</div><strong>{b.name}</strong><small>{b.tier}</small></button>)}</section>
      <button className="banner" onClick={() => setTab('recommend')}><div><h2>پیشنهاد هوشمند غذا</h2><p>مشکل پتت رو انتخاب کن تا بهترین گزینه ها نمایش داده شود.</p></div><Sparkles size={42}/></button>
      <section className="section-head"><h2>محصولات پیشنهادی</h2><span>{list.length} غذا</span></section>
      <section className="products">{list.map(p => <ProductCard key={p.id} product={p}/>)}</section>
    </main>
  </>;
}

function ProblemTabs({ selected, setSelected }) {
  return <section className="chips">{problems.map(p => <button key={p} className={selected === p ? 'active' : ''} onClick={() => setSelected(p)}>{p}</button>)}</section>;
}

function BrandsScreen() {
  const [q, setQ] = useState('');
  const filtered = brands.filter(b => b.name.includes(q) || b.latin.toLowerCase().includes(q.toLowerCase()) || b.tier.includes(q));
  return <main className="content top-content">
    <section className="page-title"><p>کاتالوگ برندها</p><h1>همه برندهای پت</h1></section>
    <label className="input"><Search size={18}/><input value={q} onChange={e => setQ(e.target.value)} placeholder="جستجو در برندها..." /></label>
    <section className="brand-list">{filtered.map(b => <BrandCard key={b.id} brand={b}/>)}</section>
  </main>;
}

function RecommendScreen({ problem, setProblem, list }) {
  const title = problem === 'همه' ? 'همه غذاهای پیشنهادی' : 'پیشنهاد برای مشکل ' + problem;
  return <main className="content top-content">
    <section className="recommend-hero"><div><p>AI Recommendation</p><h1>{title}</h1><span>انتخاب کن تا لیست غذاها فوری تغییر کند.</span></div><Stethoscope size={42}/></section>
    <ProblemTabs selected={problem} setSelected={setProblem}/>
    <section className="mini-stats"><div><ShieldCheck size={18}/><b>{list.length}</b><span>گزینه مناسب</span></div><div><Scale size={18}/><b>{problem}</b><span>فیلتر فعال</span></div></section>
    <section className="products">{list.map(p => <ProductCard key={p.id} product={p}/>)}</section>
  </main>;
}

function ProfileScreen() {
  return <main className="content top-content"><section className="profile"><div className="avatar"><User size={44}/></div><h1>پروفایل پت</h1><p>در مرحله بعد سن، وزن، نژاد، حساسیت ها و برنامه غذایی هر پت اینجا ذخیره می شود.</p></section></main>;
}

function BottomNav({ tab, setTab }) {
  const items = [['home', Home, 'خانه'], ['brands', PawPrint, 'برندها'], ['recommend', Sparkles, 'پیشنهادها'], ['profile', User, 'پروفایل']];
  return <nav className="bottom-nav">{items.map(([id, Icon, label]) => <button key={id} className={tab === id ? 'active' : ''} onClick={() => setTab(id)}><Icon size={21}/><span>{label}</span></button>)}</nav>;
}

function App() {
  const [tab, setTab] = useState('home');
  const [problem, setProblem] = useState('همه');
  const list = useMemo(() => problem === 'همه' ? products : products.filter(p => p.problem === problem), [problem]);
  return <div className="app-shell">
    {tab === 'home' && <HomeScreen setTab={setTab} problem={problem} setProblem={setProblem} list={list}/>} 
    {tab === 'brands' && <BrandsScreen/>}
    {tab === 'recommend' && <RecommendScreen problem={problem} setProblem={setProblem} list={list}/>} 
    {tab === 'profile' && <ProfileScreen/>}
    <BottomNav tab={tab} setTab={setTab}/>
  </div>;
}

createRoot(document.getElementById('root')).render(<App />);
