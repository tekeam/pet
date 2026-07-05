import React, { useMemo, useState } from 'react';
import { createRoot } from 'react-dom/client';
import { Search, Star, Heart, Bell, Home, PawPrint, Sparkles, User } from 'lucide-react';
import './styles.css';

const brands = [
  { id: 'royal', name: 'رویال کنین', latin: 'Royal Canin', tier: 'سوپرپرمیوم', short: 'RC' },
  { id: 'acana', name: 'آکانا', latin: 'Acana', tier: 'پرمیوم', short: 'AC' },
  { id: 'hills', name: 'هیلز', latin: 'Hills', tier: 'درمانی', short: 'HL' },
  { id: 'whiskas', name: 'ویسکاس', latin: 'Whiskas', tier: 'اقتصادی', short: 'WK' }
];

const products = [
  { id: 1, brand: 'رویال کنین', name: 'گاسترواینتستینال', problem: 'گوارشی', price: '۱,۸۵۰,۰۰۰', rating: 4.8, color: '#7c3aed' },
  { id: 2, brand: 'رویال کنین', name: 'رنال', problem: 'کلیوی', price: '۱,۹۲۰,۰۰۰', rating: 4.7, color: '#2563eb' },
  { id: 3, brand: 'آکانا', name: 'ایندور انتری', problem: 'کنترل وزن', price: '۲,۲۰۰,۰۰۰', rating: 4.8, color: '#059669' },
  { id: 4, brand: 'ویسکاس', name: 'ادالت چیکن', problem: 'اقتصادی', price: '۴۹۰,۰۰۰', rating: 4.1, color: '#db2777' }
];

function ProductCard({ product }) {
  return <article className="product-card">
    <div className="bag" style={{ background: product.color }}><PawPrint size={26}/></div>
    <div><small>{product.brand}</small><h3>{product.name}</h3><p>مناسب برای: {product.problem}</p><b>{product.price} تومان</b></div>
    <span className="rating"><Star size={14} fill="currentColor"/> {product.rating}</span>
  </article>;
}

function App() {
  const [problem, setProblem] = useState('همه');
  const problems = ['همه', 'گوارشی', 'کلیوی', 'کنترل وزن', 'اقتصادی'];
  const list = useMemo(() => problem === 'همه' ? products : products.filter(p => p.problem === problem), [problem]);
  return <div className="app-shell">
    <header className="hero">
      <div className="hero-actions"><button><Heart size={19}/></button><button><Bell size={19}/></button></div>
      <p className="eyebrow">Pettt AI Food Finder</p>
      <h1>غذای مناسب پتتو پیدا کن</h1>
      <p>مرجع فارسی برندها، محصولات و پیشنهاد غذای حیوانات خانگی.</p>
      <div className="search"><Search size={19}/><span>جستجو در برندها، غذاها و مشکلات...</span></div>
    </header>
    <main className="content">
      <section className="chips">{problems.map(p => <button key={p} className={problem === p ? 'active' : ''} onClick={() => setProblem(p)}>{p}</button>)}</section>
      <section className="section-head"><h2>برندهای محبوب</h2><span>مشاهده همه</span></section>
      <section className="brand-grid">{brands.map(b => <article className="brand" key={b.id}><div>{b.short}</div><strong>{b.name}</strong><small>{b.tier}</small></article>)}</section>
      <section className="banner"><div><h2>پیشنهاد هوشمند غذا</h2><p>مشکل پتت رو انتخاب کن تا بهترین گزینه‌ها نمایش داده شود.</p></div><Sparkles size={42}/></section>
      <section className="section-head"><h2>محصولات پیشنهادی</h2><span>{list.length} غذا</span></section>
      <section className="products">{list.map(p => <ProductCard key={p.id} product={p}/>)}</section>
    </main>
    <nav className="bottom-nav"><button className="active"><Home size={21}/><span>خانه</span></button><button><PawPrint size={21}/><span>برندها</span></button><button><Sparkles size={21}/><span>پیشنهادها</span></button><button><User size={21}/><span>پروفایل</span></button></nav>
  </div>;
}

createRoot(document.getElementById('root')).render(<App />);
