import React, { useMemo, useState } from 'react';
import { createRoot } from 'react-dom/client';
import { Search, Star, Heart, Bell, Home, PawPrint, Sparkles, User, ChevronLeft, ShieldCheck, Scale, Stethoscope, Camera, ImagePlus, Send, MessageCircle, Bookmark, Settings } from 'lucide-react';
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
const demoImages = [
  'https://images.unsplash.com/photo-1552053831-71594a27632d?q=80&w=900&auto=format&fit=crop',
  'https://images.unsplash.com/photo-1574158622682-e40e69881006?q=80&w=900&auto=format&fit=crop',
  'https://images.unsplash.com/photo-1583511655826-05700442b31b?q=80&w=900&auto=format&fit=crop'
];

function ProductCard({ product }) {
  return <article className="product-card"><div className="bag" style={{ background: product.color }}><PawPrint size={26}/></div><div><small>{product.brand}</small><h3>{product.name}</h3><p>{product.reason}</p><b>{product.price} تومان</b></div><span className="rating"><Star size={14} fill="currentColor"/> {product.rating}</span></article>;
}

function BrandCard({ brand }) {
  const count = products.filter(p => p.brandId === brand.id).length;
  return <article className="brand-row"><div className="brand-logo">{brand.short}</div><div><h3>{brand.name}</h3><p>{brand.latin} | {brand.tier} | {brand.country}</p><span>{brand.desc}</span></div><b>{count} غذا</b></article>;
}

function ProblemTabs({ selected, setSelected }) {
  return <section className="chips">{problems.map(p => <button key={p} className={selected === p ? 'active' : ''} onClick={() => setSelected(p)}>{p}</button>)}</section>;
}

function HomeScreen({ setTab, problem, setProblem, list }) {
  return <><header className="hero"><div className="hero-actions"><button><Heart size={19}/></button><button><Bell size={19}/></button></div><p className="eyebrow">Pettt AI Food Finder</p><h1>غذای مناسب پتتو پیدا کن</h1><p>مرجع فارسی برندها، محصولات، پروفایل پت و اکسپلور عکس حیوانات خانگی.</p><button className="search" onClick={() => setTab('brands')}><Search size={19}/><span>جستجو در برندها و غذاها...</span></button></header><main className="content"><ProblemTabs selected={problem} setSelected={setProblem}/><section className="section-head"><h2>برندهای محبوب</h2><button onClick={() => setTab('brands')}>مشاهده همه <ChevronLeft size={15}/></button></section><section className="brand-grid">{brands.slice(0,4).map(b => <button className="brand" key={b.id} onClick={() => setTab('brands')}><div>{b.short}</div><strong>{b.name}</strong><small>{b.tier}</small></button>)}</section><button className="banner" onClick={() => setTab('recommend')}><div><h2>پیشنهاد هوشمند غذا</h2><p>مشکل پتت رو انتخاب کن تا بهترین گزینه ها نمایش داده شود.</p></div><Sparkles size={42}/></button><section className="section-head"><h2>محصولات پیشنهادی</h2><span>{list.length} غذا</span></section><section className="products">{list.map(p => <ProductCard key={p.id} product={p}/>)}</section></main></>;
}

function BrandsScreen() {
  const [q, setQ] = useState('');
  const filtered = brands.filter(b => b.name.includes(q) || b.latin.toLowerCase().includes(q.toLowerCase()) || b.tier.includes(q));
  return <main className="content top-content"><section className="page-title"><p>کاتالوگ برندها</p><h1>همه برندهای پت</h1></section><label className="input"><Search size={18}/><input value={q} onChange={e => setQ(e.target.value)} placeholder="جستجو در برندها..." /></label><section className="brand-list">{filtered.map(b => <BrandCard key={b.id} brand={b}/>)}</section></main>;
}

function RecommendScreen({ problem, setProblem, list }) {
  const title = problem === 'همه' ? 'همه غذاهای پیشنهادی' : 'پیشنهاد برای مشکل ' + problem;
  return <main className="content top-content"><section className="recommend-hero"><div><p>AI Recommendation</p><h1>{title}</h1><span>انتخاب کن تا لیست غذاها فوری تغییر کند.</span></div><Stethoscope size={42}/></section><ProblemTabs selected={problem} setSelected={setProblem}/><section className="mini-stats"><div><ShieldCheck size={18}/><b>{list.length}</b><span>گزینه مناسب</span></div><div><Scale size={18}/><b>{problem}</b><span>فیلتر فعال</span></div></section><section className="products">{list.map(p => <ProductCard key={p.id} product={p}/>)}</section></main>;
}

function ExploreScreen({ posts, setPosts }) {
  const like = id => setPosts(posts.map(p => p.id === id ? { ...p, likes: p.likes + 1 } : p));
  return <main className="content top-content"><section className="explore-head"><Search size={20}/><h1>اکسپلور</h1><Sparkles size={22}/></section><section className="feed">{posts.map(post => <article className="post-card" key={post.id}><div className="post-meta"><div className="mini-avatar">{post.petName.slice(0,1)}</div><div><b>{post.owner}</b><span>{post.time}</span></div></div><img className="post-photo" src={post.image} alt={post.petName}/><div className="post-body"><h2>{post.petName} <small>{post.breed}</small></h2><p>{post.caption}</p><div className="food-line">غذای محبوب: <b>{post.food}</b></div><div className="post-actions"><button onClick={() => like(post.id)}><Heart size={18} fill="currentColor"/> {post.likes}</button><button><MessageCircle size={18}/> {post.comments}</button><button><Bookmark size={18}/></button></div></div></article>)}</section></main>;
}

function ProfileScreen({ pet, setPet, setTab, addPost }) {
  const [draft, setDraft] = useState('');
  const [postImage, setPostImage] = useState('');
  const handlePetPhoto = e => { const file = e.target.files?.[0]; if (file) setPet({ ...pet, photo: URL.createObjectURL(file) }); };
  const handlePostPhoto = e => { const file = e.target.files?.[0]; if (file) setPostImage(URL.createObjectURL(file)); };
  const publish = () => { if (!postImage && !draft.trim()) return; addPost({ image: postImage || pet.photo || demoImages[0], caption: draft || 'امروز یه روز عالی داشتیم!', petName: pet.name, breed: pet.breed, food: pet.food }); setDraft(''); setPostImage(''); setTab('explore'); };
  return <main className="content top-content"><section className="profile-top"><Settings size={20}/><h1>پروفایل من</h1><Bell size={20}/></section><section className="pet-card"><label className="pet-photo"><img src={pet.photo || demoImages[0]} alt={pet.name}/><input type="file" accept="image/*" onChange={handlePetPhoto}/><span><Camera size={18}/></span></label><div><h2>{pet.name} {pet.gender === 'نر' ? '♂' : '♀'}</h2><p>{pet.breed} | {pet.weight || 0} کیلوگرم</p><div className="tag-row">{pet.diseases.split(',').filter(Boolean).map(x => <span key={x}>{x.trim()}</span>)}</div></div></section><section className="form-card"><label>اسم پت<input value={pet.name} onChange={e => setPet({ ...pet, name: e.target.value })}/></label><label>جنسیت<select value={pet.gender} onChange={e => setPet({ ...pet, gender: e.target.value })}><option>نر</option><option>ماده</option></select></label><label>نژاد<input value={pet.breed} onChange={e => setPet({ ...pet, breed: e.target.value })}/></label><label>وزن<input value={pet.weight} onChange={e => setPet({ ...pet, weight: e.target.value })}/></label><label>بیماری خاص<input value={pet.diseases} onChange={e => setPet({ ...pet, diseases: e.target.value })} placeholder="مثلا گوارشی، حساسیت پوستی"/></label><label>غذای محبوب<input value={pet.food} onChange={e => setPet({ ...pet, food: e.target.value })}/></label></section><section className="new-post"><h2>پست جدید</h2><label className="upload-box">{postImage ? <img src={postImage} alt="new post"/> : <><ImagePlus size={36}/><span>عکس پت را انتخاب کن</span></>}<input type="file" accept="image/*" onChange={handlePostPhoto}/></label><textarea value={draft} onChange={e => setDraft(e.target.value)} placeholder="متن زیر عکس را بنویس..." maxLength={220}/><button className="publish" onClick={publish}><Send size={18}/> انتشار در اکسپلور</button></section></main>;
}

function BottomNav({ tab, setTab }) {
  const items = [['home', Home, 'خانه'], ['brands', PawPrint, 'برندها'], ['recommend', Sparkles, 'پیشنهادها'], ['explore', Search, 'اکسپلور'], ['profile', User, 'پروفایل']];
  return <nav className="bottom-nav five">{items.map(([id, Icon, label]) => <button key={id} className={tab === id ? 'active' : ''} onClick={() => setTab(id)}><Icon size={21}/><span>{label}</span></button>)}</nav>;
}

function App() {
  const [tab, setTab] = useState('home');
  const [problem, setProblem] = useState('همه');
  const [pet, setPet] = useState({ name: 'بیلی', gender: 'نر', breed: 'گلدن رتریور', weight: '۲۵', diseases: 'مشکل گوارشی, حساسیت پوستی', food: 'Royal Canin Gastrointestinal', photo: demoImages[0] });
  const [posts, setPosts] = useState([
    { id: 3, owner: 'النا و لونا', petName: 'لونا', breed: 'پامرینین', food: 'Royal Canin Pomeranian', caption: 'امروز کلی بازی کرد و خوشحال بود.', image: demoImages[1], likes: 24, comments: 3, time: '۵ دقیقه پیش' },
    { id: 2, owner: 'نیلوفر و میو', petName: 'میو', breed: 'بریتیش شورت هیر', food: 'Royal Canin Sterilised', caption: 'میو عاشق آفتاب کنار پنجره است.', image: demoImages[2], likes: 31, comments: 4, time: '۱۲ دقیقه پیش' },
    { id: 1, owner: 'محمد و آرلو', petName: 'آرلو', breed: 'کرگی', food: 'Brit Care Adult', caption: 'اولین پست آرلو در Pettt.', image: 'https://images.unsplash.com/photo-1612536057832-2ff7ead58194?q=80&w=900&auto=format&fit=crop', likes: 18, comments: 2, time: '۲۵ دقیقه پیش' }
  ]);
  const addPost = post => setPosts([{ id: Date.now(), owner: 'شما و ' + post.petName, time: 'همین الان', likes: 0, comments: 0, ...post }, ...posts]);
  const list = useMemo(() => problem === 'همه' ? products : products.filter(p => p.problem === problem), [problem]);
  return <div className="app-shell">{tab === 'home' && <HomeScreen setTab={setTab} problem={problem} setProblem={setProblem} list={list}/>} {tab === 'brands' && <BrandsScreen/>}{tab === 'recommend' && <RecommendScreen problem={problem} setProblem={setProblem} list={list}/>} {tab === 'explore' && <ExploreScreen posts={posts} setPosts={setPosts}/>} {tab === 'profile' && <ProfileScreen pet={pet} setPet={setPet} setTab={setTab} addPost={addPost}/>}<BottomNav tab={tab} setTab={setTab}/></div>;
}

createRoot(document.getElementById('root')).render(<App />);
